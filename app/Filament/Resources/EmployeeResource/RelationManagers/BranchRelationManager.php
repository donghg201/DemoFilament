<?php

namespace App\Filament\Resources\EmployeeResource\RelationManagers;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class BranchRelationManager extends RelationManager
{
    protected static string $relationship = 'Branch';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('Branch_Id')
                    ->numeric()
                    ->required(),
                TextInput::make('Name')
                    ->required()
                    ->maxLength(225),
                TextInput::make('Address')
                    ->maxLength(225),
                TextInput::make('City')
                    ->maxLength(225),
                TextInput::make('State')
                    ->maxLength(225),
                TextInput::make('Zip_Code')
                    ->label('Zip Code')
                    ->maxLength(50),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('Name')
            ->columns([
                TextColumn::make('Branch_Id')
                    ->label('ID')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('Name')
                    ->sortable()
                    ->searchable()
                    ->limit(30),
                TextColumn::make('Address')
                    ->sortable()
                    ->searchable()
                    ->limit(50),
                TextColumn::make('City')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('State')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('Zip_Code')
                    ->label('Zip Code')
                    ->sortable()
                    ->searchable(),
            ])->defaultSort('Branch_Id')
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
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
}
