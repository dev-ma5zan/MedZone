<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OfferResource\Pages;
use App\Filament\Resources\OfferResource\RelationManagers;
use App\Models\Offer;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OfferResource extends Resource
{
    protected static ?string $model = Offer::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $label = 'عرض';

    protected static ?string $pluralLabel = 'العروض';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('code')
                    ->required()
                    ->label('الكود')
                    ->maxLength(255),
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->label('العنوان')
                    ->maxLength(255),
                Forms\Components\DatePicker::make('starts_at')
                    ->required()
                    ->label('يبدأ في'),
                Forms\Components\DatePicker::make('ends_at')
                    ->required()
                    ->label('ينتهي في'),
                Forms\Components\MultiSelect::make('customer_id')
                    ->required()
                    ->preload()
                    ->relationship('customer','business_name')
                    ->label('الزبون'),
                Forms\Components\TextInput::make('minimal_overall_price')
                    ->required()
                    ->label('اقل سعر اجمالي')
                    ->maxLength(255),
                Forms\Components\TextInput::make('discount_percentage')
                    ->required()
                    ->label('قيمة القصم')
                    ->maxLength(255),
                Forms\Components\TextInput::make('new_price')
                    ->required()
                    ->label('السعر الجديد')
                    ->maxLength(255),
                Forms\Components\Repeater::make('products')
                    ->schema([
                        Forms\Components\Select::make('product')
                            ->relationship('product', 'code')
                            ->preload()
                            ->required(),
                        Forms\Components\TextInput::make('price')
                            ->required(),
                    ])
                    ->columns(3)->columnSpan(function (?offer $record)
                        { 
                            if($record == null)
                                    return 'full';
                                else
                                    return 2;
                        }),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code')
                    ->label('الكود'),
                Tables\Columns\TextColumn::make('title')
                    ->label('العنوان'),
                Tables\Columns\TextColumn::make('products')
                    ->label('المنتجات'),
                Tables\Columns\TextColumn::make('starts_at')
                    ->label('يبدأ في')
                    ->date(),
                Tables\Columns\TextColumn::make('ends_at')
                    ->label('ينتهي في')
                    ->date(),
                Tables\Columns\TextColumn::make('customer.name')
                    ->label('الزبون'),
                Tables\Columns\TextColumn::make('minimal_overall_price')
                    ->label('اقل سعر اجمالي'),
                Tables\Columns\TextColumn::make('discount_percentage')
                    ->label('نسبة الخصم'),
                Tables\Columns\TextColumn::make('new_price')
                    ->label('السعر الجديد'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->label('تم الانشاء'),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->label('تم التعديل'),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->label('تم الحذف'),
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
            'index' => Pages\ListOffers::route('/'),
            'create' => Pages\CreateOffer::route('/create'),
            'view' => Pages\ViewOffer::route('/{record}'),
            'edit' => Pages\EditOffer::route('/{record}/edit'),
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
