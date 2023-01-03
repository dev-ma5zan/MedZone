<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VendorResource\Pages;
use App\Filament\Resources\VendorResource\RelationManagers;
use App\Models\Vendor;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VendorResource extends Resource
{
    protected static ?string $model = Vendor::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';

    protected static ?string $label = 'مورد';

    protected static ?string $pluralLabel = 'الموردين';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\TextInput::make('business_name')
                            ->label('اسم المورد')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('mobile')
                            ->label('رقم الهاتف')
                            ->tel()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('code')
                            ->label('الكود')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('website')
                            ->label('البريد الالكتروني')
                            ->url()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('land_phone')
                            ->label('الرقم الارضي')
                            ->tel()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Select::make('speciality_id')
                            ->label('التخصص')
                            ->relationship('VendorSpeciality', 'name')
                            ->required(),
                        Forms\Components\TextInput::make('rating')
                            ->label('التقييم')
                            ->required()
                            ->maxLength(255),
                    ])->columns(2)->columnSpan(function (?vendor $record)
                        { 
                            if($record == null)
                                    return 'full';
                                else
                                    return 2;
                        }),
                    Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\Placeholder::make('created_at')
                            ->label('تم الانشاء')
                            ->content(fn (?vendor $record): string => $record ? $record->created_at->diffForHumans() : '-'),
                        Forms\Components\Placeholder::make('updated_at')
                            ->label('تم التعديل')
                            ->content(fn (?vendor $record): string => $record ? $record->updated_at->diffForHumans() : '-'),
                    ])->columnSpan(1)->hidden(fn (?vendor $record) => $record == null),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('business_name')
                    ->label('اسم المورد')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('mobile')
                    ->label('رقم الهاتف')
                    ->searchable(),
                Tables\Columns\TextColumn::make('code')
                    ->label('الكود')
                    ->searchable(),
                Tables\Columns\TextColumn::make('speciality.name')
                    ->label('التخصص'),
                Tables\Columns\TextColumn::make('land_phone')
                    ->label('الرقم الارضي')
                    ->searchable(),
                Tables\Columns\TextColumn::make('website')
                    ->label('الموقع الالكتروني')
                    ->searchable(),
                Tables\Columns\TextColumn::make('rating')
                    ->label('التقييم')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('تم انشائها')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('تم تعديلها')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->label('تم حذفها')
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
            'index' => Pages\ListVendors::route('/'),
            'create' => Pages\CreateVendor::route('/create'),
            'view' => Pages\ViewVendor::route('/{record}'),
            'edit' => Pages\EditVendor::route('/{record}/edit'),
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
