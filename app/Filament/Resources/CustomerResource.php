<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomerResource\Pages;
use App\Filament\Resources\CustomerResource\RelationManagers;
use App\Models\Customer;
use App\Models\area;
use App\Models\SubAddress;
use App\Models\street;
use App\Models\sector;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;

class CustomerResource extends Resource
{
    protected static ?string $model = Customer::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $label = 'زبون';

    protected static ?string $pluralLabel = 'الزبائن';

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\TextInput::make('full_name')
                            ->label('الاسم الكامل')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('business_name')
                            ->label('اسم المركز')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('mobile')
                            ->label('رقم الهاتف')
                            ->tel()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('land_phone')
                            ->label('رقم الهاتف الارضي')
                            ->tel()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Select::make('customer_speciality_id')
                            ->relationship('CustomerSpeciality','name')
                            ->label('التخصص')
                            ->required(),
                        Forms\Components\Select::make('activity_id')
                            ->label('الفعاليات')
                            ->required()
                            ->relationship('activities','name'),
                        Forms\Components\Select::make('business_hours_id')
                            ->label('ساعات العمل')
                            ->required()
                            ->relationship('BusinessHours','day'),
                        Forms\Components\MultiSelect::make('vendor_id')
                            ->label('المورد المعتاد')
                            ->required()
                            ->preload()
                            ->relationship('vendor','business_name'),
                        Forms\Components\Select::make('preferred_buying_method_id')
                            ->label('طرية الدفع المفضلة')
                            ->required()
                            ->relationship('PreferredBuyingMethod','name'),
                        Forms\Components\Select::make('insurance_id')
                            ->label('التامين')
                            ->required()
                            ->relationship('insurance','name'),
                        Forms\Components\Textarea::make('behavior')
                            ->label('التعامل')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Textarea::make('notes')
                            ->label('ملاحظات')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('rating')
                            ->label('التقييم')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('secretary_name')
                            ->label('اسم السكرتير')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('secretary_mobile')
                            ->label('رقم السكرتير')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Repeater::make('documents')
                            ->schema([
                                Forms\Components\FileUpload::make('document')
                                    ->label('الملف')
                                    ->directory('CustomerResource/Documents'),
                            ])
                            ->columns(1)->columnSpan(2)->required(),
                    ])->columns(2)->columnSpan(1),
                    Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\Select::make('location_type_id')
                            ->label('نوع العنوان')
                            ->required()
                            ->relationship('LocationType','name'),
                        Forms\Components\Select::make('staff_id')
                            ->label('عدد الموظفين')
                            ->required()
                            ->relationship('staff','name'),
                        Forms\Components\Select::make('size_id')
                            ->label('المساحة')
                            ->required()
                            ->relationship('size','name'),
                        Forms\Components\Select::make('decor_id')
                            ->label('الديكور')
                            ->required()
                            ->relationship('decor','name'),
                        Forms\Components\Select::make('power_id')
                            ->label('الطاقة')
                            ->required()
                            ->relationship('power','name'),
                    ])->columns(2)->columnSpan(1),
                    Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\Select::make('area_id')
                            ->label('المنطقة')
                            ->reactive()
                            ->afterStateUpdated(fn (callable $set) => $set('sector_id', null))
                            ->required()
                            ->relationship('area','name'),
                        Forms\Components\Select::make('sector_id')
                            ->label('القطاع')
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(fn (callable $set) => $set('sub_address_id', null))
                            ->options(function (callable $get)
                            {
                                $area = area::find($get('area_id'));

                                if(! $area)
                                {
                                    return sector::all()->pluck('name', 'id');
                                }

                                return $area->sector->pluck('name', 'id');
                            }),
                        Forms\Components\Select::make('sub_address_id')
                            ->label('العنوان الفرعي')
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(fn (callable $set) => $set('street_id', null))
                            ->options(function (callable $get)
                            {
                                $sector = sector::find($get('sector_id'));

                                if(! $sector)
                                {
                                    return SubAddress::all()->pluck('name', 'id');
                                }

                                return $sector->SubAddress->pluck('name', 'id');
                            }),
                        Forms\Components\Select::make('street_id')
                            ->label('الشارع')
                            ->required()
                            ->options(function (callable $get)
                            {
                                $SubAddress = SubAddress::find($get('sub_address_id'));

                                if(! $SubAddress)
                                {
                                    return street::all()->pluck('name', 'id');
                                }

                                return $SubAddress->street->pluck('name', 'id');
                            }),
                        Forms\Components\TextInput::make('detailed_address')
                            ->label('وصف الموقع'),
                    ])->columns(2)->columnSpan(1),
                    Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\Placeholder::make('created_at')
                            ->label('تم الانشاء')
                            ->content(fn (?customer $record): string => $record ? $record->created_at->diffForHumans() : '-'),
                        Forms\Components\Placeholder::make('updated_at')
                            ->label('تم التعديل')
                            ->content(fn (?customer $record): string => $record ? $record->updated_at->diffForHumans() : '-'),
                    ])->columnSpan(1)->hidden(fn (?customer $record) => $record == null),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('full_name')
                    ->label('الاسم الكامل')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('business_name')
                    ->label('اسم المركز')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('mobile')
                    ->label('رقم الهاتف')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('تم الانشاء')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('تم التعديل')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('deleted_at')
                ->label('تم الحذف')
                ->dateTime(),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                Tables\Actions\ForceDeleteBulkAction::make(),
                Tables\Actions\RestoreBulkAction::make(),
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCustomers::route('/'),
            'create' => Pages\CreateCustomer::route('/create'),
            'view' => Pages\ViewCustomer::route('/{record}'),
            'edit' => Pages\EditCustomer::route('/{record}/edit'),
        ];
    }    
    
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
