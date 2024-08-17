<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-storefront';

    protected static ?string $navigationGroup = 'Product';

    protected static ?string $recordTitleAttribute = 'Name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('Product_Id')
                    ->numeric()
                    ->label('Product ID')
                    ->required(),
                TextInput::make('Name')
                    ->required()
                    ->maxLength(225),
                DatePicker::make('Date_Offered')
                    ->label('Date Offered')
                    ->native(false)
                    ->closeOnDateSelection()
                    ->prefix('Starts'),
                DatePicker::make('Date_Retired')
                    ->label('Date Offered')
                    ->native(false)
                    ->closeOnDateSelection()
                    ->prefix('Ends'),
                Select::make('Product_Type_Id')
                    ->relationship(name: 'ProductType', titleAttribute: 'Name')
                    ->label('Product Type ID')
                    ->required()
                    ->native(false)
                    ->searchable()
                    ->preload(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('Product_Id')
                    ->label('ID')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('Name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('Date_Offered')
                    ->date()
                    ->searchable()
                    ->sortable()
                    ->label('Date Offered'),
                TextColumn::make('Date_Retired')
                    ->label('Date Retired')
                    ->sortable()
                    ->searchable()
                    ->date(),
                TextColumn::make('Product_Type_Id')
                    ->sortable()
                    ->searchable()
                    ->label('Product Type ID'),
            ])->defaultSort('Product_Id')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\ACtions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
