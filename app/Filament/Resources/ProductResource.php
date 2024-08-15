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

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Product';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('Product_Id')
                    ->label('Product ID')
                    ->required(),
                TextInput::make('Name')
                    ->required(),
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
                    ->native(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('Product_Id')
                    ->label('ID'),
                TextColumn::make('Name'),
                TextColumn::make('Date_Offered')
                    ->date()
                    ->label('Date Offered'),
                TextColumn::make('Date_Retired')
                    ->label('Date Retired')
                    ->date(),
                TextColumn::make('Product_Type_Id')
                    ->label('Product Type ID'),
            ])
            ->filters([
                //
            ])
            ->actions([
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
