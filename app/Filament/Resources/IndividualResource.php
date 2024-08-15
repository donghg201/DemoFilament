<?php

namespace App\Filament\Resources;

use App\Filament\Resources\IndividualResource\Pages;
use App\Models\Individual;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class IndividualResource extends Resource
{
    protected static ?string $model = Individual::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Customer';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('First_Name')
                    ->label('First Name')
                    ->required(),
                TextInput::make('Last_Name')
                    ->label('Last Name')
                    ->required(),
                DatePicker::make('Birthday')
                    ->native(false)
                    ->closeOnDateSelection(),
                Select::make('Cust_Id')
                    ->label('Customer ID')
                    ->relationship(name: 'Customer', titleAttribute: 'Cust_Id')
                    ->required()
                    ->native(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('First_Name')
                    ->label('First Name'),
                TextColumn::make('Last_Name')
                    ->label('Last Name'),
                TextColumn::make('Birthday')
                    ->date(),
                TextColumn::make('Cust_Id')
                    ->label('Customer ID'),
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
            'index' => Pages\ListIndividuals::route('/'),
            'create' => Pages\CreateIndividual::route('/create'),
            'edit' => Pages\EditIndividual::route('/{record}/edit'),
        ];
    }
}
