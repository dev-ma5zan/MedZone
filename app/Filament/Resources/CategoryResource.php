<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Filament\Resources\CategoryResource\RelationManagers;
use App\Models\Category;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $label = 'فئة';

    protected static ?string $pluralLabel = 'الفئات';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('الاسم')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\FileUpload::make('icon')
                            ->directory('CategoryResource/icon')
                            ->label('الصورة'),
                        Forms\Components\Select::make('category_id')
                            ->label('الفئة الاب')
                            ->relationship('Category','name'),
                        Forms\Components\Toggle::make('visability')
                            ->label('ظاهرة')
                            ->inline(false)
                            ->onColor('success')
                            ->offColor('danger'),
                    ])->columns(2)->columnSpan(function (?category $record)
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
                            ->content(fn (?category $record): string => $record ? $record->created_at->diffForHumans() : '-'),
                        Forms\Components\Placeholder::make('updated_at')
                            ->label('تم التعديل')
                            ->content(fn (?category $record): string => $record ? $record->updated_at->diffForHumans() : '-'),
                    ])->columnSpan(['lg' => 1])->hidden(fn (?category $record) => $record == null),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('الاسم'),
                Tables\Columns\ImageColumn::make('icon')
                    ->label('الصورة')
                    ->square(),
                Tables\Columns\TextColumn::make('slug')
                    ->label('الكود'),
                Tables\Columns\TextColumn::make('Category.name')
                    ->label('الفئة الاب'),
                Tables\Columns\ToggleColumn::make('visability')
                    ->label('ظاهرة'),
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
                Tables\Actions\DeleteAction::make()
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
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'view' => Pages\ViewCategory::route('/{record}'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }    
}
