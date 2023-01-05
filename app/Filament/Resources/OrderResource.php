<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use App\Models\Product;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';

    protected static ?string $label = 'طلب';

    protected static ?string $pluralLabel = 'الطلبات';

    protected static ?int $navigationSort = 7;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\TextInput::make('code')
                            ->label('الكود')
                            ->required(),
                        Forms\Components\Select::make('status')
                            ->label('الحالة')
                            ->options([
                                'Pending' => 'قيد المعالجة',
                                'Assigned' => 'تم قبول الطلب',
                                'Canceled' => 'تم الغاء الطلب',
                                'Payed' => 'تم الدفع',
                                'Archived' => 'تم ارشافه',
                            ])
                            ->default('Pending')
                            ->required(),
                        Forms\Components\Select::make('customer_id')
                            ->label('الزبون')
                            ->relationship('Customer', 'business_name')
                            ->required(),
                        Forms\Components\Select::make('user_id')
                            ->label('الموظف المسؤول')
                            ->relationship('user', 'name'),
                        Forms\Components\Repeater::make('products')
                            ->schema([
                                Forms\Components\Select::make('product')
                                    ->relationship('Product', 'code')
                                    ->preload()
                                    ->required()
                                    ->reactive()
                                    ->afterStateUpdated(fn (callable $set) => $set('price', null)),
                                Forms\Components\TextInput::make('amount')
                                    ->numeric()
                                    ->reactive()
                                    ->default(1)
                                    ->minValue(1)
                                    ->required(),
                                Forms\Components\Placeholder::make('price')
                                    ->disabled()
                                    ->content(function (callable $get)
                                    {
                                        $product = Product::find($get('product'));

                                        if(! $product)
                                        {
                                            return '0';
                                        }

                                        $price = $product->pluck('prices')[0];
                                        return $price;
                                    }),
                            ])
                            ->columns(3)->columnSpan(2),
                        Forms\Components\TextInput::make('total'),
                    ])->columns(2)->columnSpan(function (?order $record)
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
                            ->content(fn (?order $record): string => $record ? $record->created_at->diffForHumans() : '-'),
                        Forms\Components\Placeholder::make('updated_at')
                            ->label('تم التعديل')
                            ->content(fn (?order $record): string => $record ? $record->updated_at->diffForHumans() : '-'),
                    ])->columnSpan(1)->hidden(fn (?order $record) => $record == null),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code')
                    ->label('الكود'),
                Tables\Columns\TextColumn::make('status')
                    ->label('الحالة'),
                Tables\Columns\TextColumn::make('Customer.business_name')
                    ->label('اسم الزبون'),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('اسم الموظف المسؤول'),
                Tables\Columns\TextColumn::make('Product.code')
                    ->label('المنتج'),
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
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'view' => Pages\ViewOrder::route('/{record}'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
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
