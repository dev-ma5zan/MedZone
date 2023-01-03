<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReviewResource\Pages;
use App\Filament\Resources\ReviewResource\RelationManagers;
use App\Models\Review;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ReviewResource extends Resource
{
    protected static ?string $model = Review::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $label = 'تقييم';

    protected static ?string $pluralLabel = 'التقييمات';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\Select::make('customer_id')
                            ->relationship('customer','full_name')
                            ->label('الزبون'),
                        Forms\Components\Select::make('product_id')
                            ->relationship('product','code')
                            ->label('المنتج'),
                        Forms\Components\Textarea::make('notes')
                            ->required()
                            ->label('الملاحظات')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('rating')
                            ->required()
                            ->label('التقييم')
                            ->maxLength(255),
                    ])->columns(2)->columnSpan(function (?review $record)
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
                            ->content(fn (?review $record): string => $record ? $record->created_at->diffForHumans() : '-'),
                        Forms\Components\Placeholder::make('updated_at')
                            ->label('تم التعديل')
                            ->content(fn (?review $record): string => $record ? $record->updated_at->diffForHumans() : '-'),
                    ])->columnSpan(1)->hidden(fn (?review $record) => $record == null),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('customer.name')
                    ->label('الزبون'),
                Tables\Columns\TextColumn::make('product.name')
                    ->label('المنتج'),
                Tables\Columns\TextColumn::make('rating')
                    ->label('التقييم'),
                Tables\Columns\TextColumn::make('notes')
                    ->label('الملاحظات'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('تم الانشاء')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('تم التعديل')
                    ->dateTime(),
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
            'index' => Pages\ListReviews::route('/'),
            'create' => Pages\CreateReview::route('/create'),
            'view' => Pages\ViewReview::route('/{record}'),
            'edit' => Pages\EditReview::route('/{record}/edit'),
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
