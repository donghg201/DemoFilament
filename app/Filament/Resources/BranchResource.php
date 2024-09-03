<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BranchResource\Pages;
use App\Models\Branch;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class BranchResource extends Resource
{
    protected static ?string $model = Branch::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    protected static ?string $navigationGroup = 'Branch';

    protected static ?string $recordTitleAttribute = 'Name';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        return 'info';
    }

    public static function form(Form $form): Form
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
                Select::make('Emp_Id')
                    ->relationship(name: 'Employee', titleAttribute: 'First_Name')
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
                TextColumn::make('Branch_Id')->label('ID')
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
                // TextColumn::make('City')
                //     ->sortable()
                //     ->searchable(),
                // TextColumn::make('State')
                //     ->sortable()
                //     ->searchable(),
                TextColumn::make('Zip_Code')
                    ->label('Zip Code')
                    ->sortable()
                    ->searchable(),
            ])->defaultSort('Branch_Id')
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
            'index' => Pages\ListBranches::route('/'),
            'create' => Pages\CreateBranch::route('/create'),
            'edit' => Pages\EditBranch::route('/{record}/edit'),
        ];
    }
}
