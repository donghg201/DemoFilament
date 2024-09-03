<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AccountResource\Pages;
use App\Models\Account;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Forms\Components\DatePicker;

class AccountResource extends Resource
{
    protected static ?string $model = Account::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';

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
                TextInput::make('Account_Id')
                    ->label('Account ID')
                    ->required()
                    ->numeric(),
                DatePicker::make('Last_Activity_Date')
                    ->native(false)
                    ->closeOnDateSelection(),
                DatePicker::make('Open_Date')
                    ->native(false)
                    ->closeOnDateSelection()
                    ->prefix('Starts')
                    ->required(),
                DatePicker::make('Close_Date')
                    ->native(false)
                    ->closeOnDateSelection()
                    ->prefix('Ends'),
                TextInput::make('Avail_Balance')
                    ->label('Available Balance')
                    ->numeric()
                    ->minValue(0),
                TextInput::make('Pending_Balance')
                    ->numeric()
                    ->minValue(0),
                Select::make('Status')->options([
                    'on' => 'On',
                    'lock' => 'Locked',
                    'off' => 'Off',
                ])
                    ->required()
                    ->native(false),
                Select::make('Cust_Id')
                    ->relationship(name: 'Customer', titleAttribute: 'Cust_Id')
                    ->required()
                    ->native(false)
                    ->searchable()
                    ->preload(),
                Select::make('Open_Branch_Id')
                    ->relationship(name: 'Branch', titleAttribute: 'Name')
                    ->required()
                    ->native(false)
                    ->searchable()
                    ->preload(),
                Select::make('Open_Emp_Id')
                    ->relationship(name: 'Employee', titleAttribute: 'First_Name')
                    ->required()
                    ->native(false)
                    ->searchable()
                    ->preload(),
                Select::make('Product_Id')
                    ->relationship(name: 'Product', titleAttribute: 'Name')
                    ->required()
                    ->native(false)
                    ->searchable()
                    ->preload(),
                Select::make('User_Id')
                    ->relationship(name: 'User', titleAttribute: 'Name')
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
                TextColumn::make('Account_Id')
                    ->label('ID')
                    ->searchable()
                    ->sortable(),
                // TextColumn::make('Last_Activity_Date')
                //     ->date()
                //     ->sortable()
                //     ->searchable()
                //     ->label('Last Activity Date'),
                TextColumn::make('Open_Date')
                    ->date()
                    ->sortable()
                    ->searchable()
                    ->label('Open Date'),
                TextColumn::make('Close_Date')
                    ->date()
                    ->sortable()
                    ->searchable()
                    ->label('Close Date'),
                TextColumn::make('Avail_Balance')
                    ->numeric(decimalPlaces: 2)
                    ->money('USD')
                    ->sortable()
                    ->searchable()
                    ->label('Available Balance'),
                TextColumn::make('Pending_Balance')
                    ->numeric(decimalPlaces: 2)
                    ->money('USD')
                    ->sortable()
                    ->searchable()
                    ->label('Pending Balance'),
                TextColumn::make('Status')
                    ->searchable()
                    ->sortable(),
                // TextColumn::make('Cust_Id')
                //     ->label('Customer ID')
                //     ->sortable(),
                // TextColumn::make('Open_Branch_Id')
                //     ->sortable()
                //     ->label('Branch ID'),
                // // ->getStateUsing(fn($record) => $record->Branch::class::Branch_Id::Name),
                // TextColumn::make('Open_Emp_Id')
                //     ->sortable()
                //     ->label('Employee ID'),
                // TextColumn::make('Product_Id')
                //     ->sortable()
                //     ->label('Product ID'),
            ])->defaultSort('Account_Id')
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
            'index' => Pages\ListAccounts::route('/'),
            'create' => Pages\CreateAccount::route('/create'),
            'edit' => Pages\EditAccount::route('/{record}/edit'),
        ];
    }
}
