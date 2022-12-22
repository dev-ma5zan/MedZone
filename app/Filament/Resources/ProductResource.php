<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-beaker';

    protected static ?int $navigationSort = 6;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('code')
                    ->label('الكود')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('category_id')
                    ->required()
                    ->label('الفئة')
                    ->numeric()
                    ->maxLength(4),
                Forms\Components\Textarea::make('tags')
                    ->required()
                    ->label('التاجز')
                    ->maxLength(255),
                Forms\Components\Textarea::make('availability')
                    ->required()
                    ->label('متاح')
                    ->maxLength(255),
                Forms\Components\TextInput::make('visability')
                    ->required()
                    ->label('ظاهر')
                    ->maxLength(255),
                Forms\Components\TextInput::make('featured')
                    ->required()
                    ->label('متميز')
                    ->maxLength(255),
                Forms\Components\TextInput::make('properties')
                    ->required()
                    ->label('الخصائص')
                    ->numeric()
                    ->maxLength(255),
                Forms\Components\TextInput::make('serial_number')
                    ->required()
                    ->label('الرقم المتسلسل')
                    ->maxLength(255),
                Forms\Components\TextInput::make('featured_cover_image')
                    ->required()
                    ->label('صورة الغلاف')
                    ->maxLength(255),
                Forms\Components\TextInput::make('description')
                    ->required()
                    ->label('الوصف')
                    ->maxLength(255),
                Forms\Components\TextInput::make('prices')
                    ->required()
                    ->label('السعر')
                    ->maxLength(255),
                Forms\Components\FileUpload::make('images')
                    ->directory('ProductResource/image')
                    ->label('الصور'),
                Forms\Components\Select::make('vendor_id')
                    ->relationship('vendor', 'business_name')
                    ->required()
                    ->label('المورد'),
                Forms\Components\FileUpload::make('documents')
                    ->directory('ProductResource/documents')
                    ->label('الملفات'),
                Forms\Components\TextInput::make('links')
                    ->url()
                    ->label('الروابط'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code')
                    ->sortable()
                    ->label('كود')
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->label('الوصف'),
                Tables\Columns\TextColumn::make('category_id')
                    ->label('لبفئة'),
                Tables\Columns\TextColumn::make('tags')
                    ->sortable()
                    ->label('التاغز')
                    ->searchable(),
                Tables\Columns\TextColumn::make('availability')
                    ->sortable()
                    ->label('متاح'),
                Tables\Columns\TextColumn::make('visability')
                    ->sortable()
                    ->label('ظاهر')
                    ->searchable(),
                Tables\Columns\TextColumn::make('featured')
                    ->searchable()
                    ->label('متميز')
                    ->sortable(),
                Tables\Columns\TextColumn::make('vendor_id')
                    ->searchable()
                    ->label('المورد')
                    ->sortable(),
                Tables\Columns\TextColumn::make('serial_number')
                    ->searchable()
                    ->label('الرقم التسلسلي')
                    ->sortable(),
                Tables\Columns\ImageColumn::make('images')
                    ->square()
                    ->label('الصور'),
                Tables\Columns\ImageColumn::make('featured_cover_image')
                    ->square()
                    ->label('صورة الغلاف'),
                Tables\Columns\TextColumn::make('description')
                    ->sortable()
                    ->label('الوصف'),
                Tables\Columns\TextColumn::make('documents')
                    ->sortable()
                    ->label('الملفات')
                    ->searchable(),
                Tables\Columns\TextColumn::make('links')
                    ->sortable()
                    ->label('الروابط')
                    ->searchable(),
                Tables\Columns\TextColumn::make('properties')
                    ->sortable()
                    ->label('الخصائص')
                    ->searchable(),
                Tables\Columns\TextColumn::make('prices')
                    ->sortable()
                    ->label('السعر')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->label('تم الانشاء')
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->label('تم التعديل')
                    ->sortable(),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->label('تم الحذف')
                    ->sortable(),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'view' => Pages\ViewProduct::route('/{record}'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
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
