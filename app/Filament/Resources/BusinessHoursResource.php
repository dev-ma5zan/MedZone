<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BusinessHoursResource\Pages;
use App\Filament\Resources\BusinessHoursResource\RelationManagers;
use App\Models\BusinessHours;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BusinessHoursResource extends Resource
{
    protected static ?string $model = BusinessHours::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationGroup = 'الاعدادات';

    protected static ?string $label = 'ساعة عمل';

    protected static ?string $pluralLabel = 'ساعات العمل';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('day')
                    ->label('اليوم')
                    ->required()
                    ->options([
                        'Saturday' => 'سبت',
                        'Sunday' => 'احد',
                        'Monday' => 'اثنين',
                        'Tuesday' => 'ثلاثاء',
                        'Wednesday' => 'اربعاء',
                        'Thursday' => 'خميس',
                        'Friday' => 'جمعة',
                    ]),
                Forms\Components\TimePicker::make('starts_at')
                    ->label('يبدأ في')
                    ->required(),
                Forms\Components\TimePicker::make('ends_at')
                    ->label('ينتهي في')
                    ->required(),
                Forms\Components\TextInput::make('weight')
                    ->label('الوزن')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('day')
                    ->label('اليوم'),
                Tables\Columns\TextColumn::make('starts_at')
                    ->label('يبدأ في'),
                Tables\Columns\TextColumn::make('ends_at')
                    ->label('ينتهي في'),
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
            'index' => Pages\ListBusinessHours::route('/'),
            'create' => Pages\CreateBusinessHours::route('/create'),
            'view' => Pages\ViewBusinessHours::route('/{record}'),
            'edit' => Pages\EditBusinessHours::route('/{record}/edit'),
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
