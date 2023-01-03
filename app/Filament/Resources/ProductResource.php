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

    protected static ?string $label = 'منتج';

    protected static ?string $pluralLabel = 'المنتجات';

    protected static ?int $navigationSort = 6;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\TextInput::make('code')
                            ->label('الكود')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Select::make('category_id')
                            ->required()
                            ->label('لفئة')
                            ->relationship('category','name'),
                        Forms\Components\TextInput::make('tags')
                            ->required()
                            ->label('العلامات')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('serial_number')
                            ->numeric()
                            ->required()
                            ->label('الرقم المتسلسل')
                            ->maxLength(255),
                        Forms\Components\Select::make('vendor_id')
                            ->relationship('vendor', 'business_name')
                            ->required()
                            ->label('المورد'),
                        Forms\Components\TextInput::make('prices')
                            ->required()
                            ->label('السعر')
                            ->maxLength(255),
                        Forms\Components\Textarea::make('description')
                            ->required()
                            ->label('الوصف')
                            ->maxLength(255),
                        Forms\Components\FileUpload::make('featured_cover_image')
                            ->label('صورة الغلاف')
                            ->required()
                            ->directory('ProductResource/cover_image'),
                    ])->columns(2)->columnSpan(function (?product $record)
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
                        ->content(fn (?product $record): string => $record ? $record->created_at->diffForHumans() : '-'),
                    Forms\Components\Placeholder::make('updated_at')
                        ->label('تم التعديل')
                        ->content(fn (?product $record): string => $record ? $record->updated_at->diffForHumans() : '-'),
                ])->columnSpan(1)->hidden(fn (?product $record) => $record == null),
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\Repeater::make('documents')
                            ->schema([
                                Forms\Components\FileUpload::make('document')
                                    ->label('الملف')
                                    ->directory('ProductResource/Documents'),
                            ])
                            ->columns(1)->required(),
                        Forms\Components\Repeater::make('pictures')
                            ->schema([
                                Forms\Components\FileUpload::make('picture')
                                    ->label('الصورة')
                                    ->directory('ProductResource/pictures'),
                            ])
                            ->columns(1)->required(),
                        Forms\Components\Repeater::make('links')
                            ->schema([
                                Forms\Components\TextInput::make('Url')
                                    ->label('الرابط')
                                    ->url(),
                            ])
                            ->columns(1)->required(),
                        Forms\Components\Repeater::make('properties')
                            ->schema([
                                Forms\Components\TextInput::make('property')
                                    ->label('الخصائص'),
                            ])->columns(1)->required(),
                    ])->columns(2)->columnSpan(2),
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\Toggle::make('visability')
                            ->label('ظاهرة')
                            ->inline(false)
                            ->onColor('success')
                            ->offColor('danger'),
                        
                        Forms\Components\Toggle::make('featured')
                            ->required()
                            ->label('متميز')
                            ->inline(false)
                            ->onColor('success')
                            ->offColor('danger'),
                        Forms\Components\Toggle::make('availability')
                            ->label('متاح')
                            ->inline(false)
                            ->onColor('success')
                            ->offColor('danger'),
                    ])->columns(1)->columnSpan(1),
            ])->columns(3);
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
                Tables\Columns\TextColumn::make('category.name')
                    ->label('الفئة'),
                Tables\Columns\TextColumn::make('tags')
                    ->sortable()
                    ->label('التاغز')
                    ->searchable(),
                Tables\Columns\ToggleColumn::make('availability')
                    ->sortable()
                    ->label('متاح'),
                Tables\Columns\ToggleColumn::make('visability')
                    ->sortable()
                    ->label('ظاهر')
                    ->searchable(),
                Tables\Columns\ToggleColumn::make('featured')
                    ->searchable()
                    ->label('متميز')
                    ->sortable(),
                Tables\Columns\TextColumn::make('vendor.name')
                    ->searchable()
                    ->label('المورد')
                    ->sortable(),
                Tables\Columns\TextColumn::make('serial_number')
                    ->searchable()
                    ->label('الرقم التسلسلي')
                    ->sortable(),
                Tables\Columns\ImageColumn::make('featured_cover_image')
                    ->square()
                    ->label('صورة الغلاف'),
                Tables\Columns\TextColumn::make('description')
                    ->sortable()
                    ->label('الوصف'),
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
