<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomerResource\Pages;
use App\Filament\Resources\CustomerResource\RelationManagers;
use App\Models\Customer;
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

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
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
                Forms\Components\TextInput::make('documents')
                    ->label('الملفات')
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
                Forms\Components\Select::make('area_id')
                    ->label('المنطقة')
                    ->required()
                    ->relationship('area','name'),
                Forms\Components\Select::make('business_hours_id')
                    ->label('ساعات العمل')
                    ->required()
                    ->relationship('BusinessHours','day'),
                Forms\Components\Select::make('vendor_id')
                    ->label('المورد المعتاد')
                    ->required()
                    ->relationship('vendor','business_name'),
                Forms\Components\Select::make('preferred_buying_method_id')
                    ->label('طرية الدفع المفضلة')
                    ->required()
                    ->relationship('PreferredBuyingMethod','name'),
                Forms\Components\Select::make('insurance_id')
                    ->label('التامين')
                    ->required()
                    ->relationship('insurance','name'),
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
                Forms\Components\TextInput::make('behavior')
                    ->label('التعامل')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('notes')
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
