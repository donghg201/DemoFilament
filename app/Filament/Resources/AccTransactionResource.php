<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AccTransactionResource\Pages;
use App\Models\AccTransaction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AccTransactionResource extends Resource
{
    protected static ?string $model = AccTransaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrows-right-left';

    protected static ?string $navigationGroup = 'Account';

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
                TextInput::make('Txn_Id')
                    ->numeric()
                    ->label('Txn ID')
                    ->required(),
                TextInput::make('Amount')
                    ->numeric()
                    ->required()
                    ->minValue(0),
                DatePicker::make('Funds_Avail_Date')
                    ->native(false)
                    ->required()
                    ->closeOnDateSelection(),
                DatePicker::make('Txn_Date')
                    ->native(false)
                    ->required()
                    ->closeOnDateSelection(),
                Select::make('Account_Id')
                    ->relationship(name: 'Account', titleAttribute: 'Account_Id')
                    ->required()
                    ->native(false)
                    ->searchable()
                    ->preload(),
                Select::make('Execution_Branch_Id')
                    ->relationship(name: 'Branch', titleAttribute: 'Branch_Id')
                    ->required()
                    ->native(false)
                    ->searchable()
                    ->preload(),
                Select::make('Teller_Emp_Id')
                    ->relationship(name: 'Employee', titleAttribute: 'Emp_Id')
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
                TextColumn::make('Txn_Id')
                    ->sortable()
                    ->label('ID')
                    ->searchable(),
                TextColumn::make('Amount')
                    ->sortable()
                    ->numeric(decimalPlaces: 2)
                    ->money('USD')
                    ->searchable(),
                TextColumn::make('Funds_Avail_Date')
                    ->sortable()
                    ->label('Funds Available Date')
                    ->date()
                    ->searchable(),
                TextColumn::make('Txn_Date')
                    ->sortable()
                    ->date()
                    ->searchable()
                    ->label('Txn Date'),
                TextColumn::make('Txn_Type_Id')
                    ->sortable()
                    ->searchable()
                    ->label('Txn Type ID'),
                TextColumn::make('Account_Id')
                    ->sortable()
                    ->searchable()
                //     ->label('Account ID'),
                // TextColumn::make('Execution_Branch_Id')
                //     ->sortable()
                //     ->searchable()
                //     ->label('Branch ID'),
                // TextColumn::make('Teller_Emp_Id')
                //     ->sortable()
                //     ->searchable()
                //     ->label('Employee ID'),
            ])->defaultSort('Txn_Id')
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
            'index' => Pages\ListAccTransactions::route('/'),
            'create' => Pages\CreateAccTransaction::route('/create'),
            'edit' => Pages\EditAccTransaction::route('/{record}/edit'),
        ];
    }
}
