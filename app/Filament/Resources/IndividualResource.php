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

    protected static ?string $navigationIcon = 'heroicon-s-user-circle';

    protected static ?string $navigationGroup = 'Customer';

    protected static ?string $recordTitleAttribute = 'First_Name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('First_Name')
                    ->numeric()
                    ->label('First Name')
                    ->required()
                    ->maxLength(225),
                TextInput::make('Last_Name')
                    ->label('Last Name')
                    ->maxLength(225)
                    ->required(),
                DatePicker::make('Birthday')
                    ->native(false)
                    ->closeOnDateSelection(),
                Select::make('Cust_Id')
                    ->label('Customer ID')
                    ->relationship(name: 'Customer', titleAttribute: 'Cust_Id')
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
                TextColumn::make('First_Name')
                    ->label('First Name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('Last_Name')
                    ->label('Last Name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('Birthday')
                    ->date()
                    ->searchable()
                    ->sortable(),
                // TextColumn::make('Cust_Id')
                //     ->label('Customer ID')
                //     ->sortable()
                //     ->searchable(),
            ])->defaultSort('First_Name')
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
            'index' => Pages\ListIndividuals::route('/'),
            'create' => Pages\CreateIndividual::route('/create'),
            'edit' => Pages\EditIndividual::route('/{record}/edit'),
        ];
    }
}
