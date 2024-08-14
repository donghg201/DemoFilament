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

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Account';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('Account_Id')->label('Account ID')->required(),
                DatePicker::make('Last_Activity_Date')
                    ->native(false)
                    ->closeOnDateSelection(),
                DatePicker::make('Open_Date')
                    ->native(false)
                    ->closeOnDateSelection()
                    ->prefix('Starts'),
                DatePicker::make('Close_Date')
                    ->native(false)
                    ->closeOnDateSelection()
                    ->prefix('Ends'),
                TextInput::make('Avail_Balance')
                    ->label('Available Balance')
                    ->integer()
                    ->minValue(0),
                TextInput::make('Pending_Balance')
                    ->integer()
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
                    ->native(false),
                Select::make('Open_Branch_Id')
                    ->relationship(name: 'Branch', titleAttribute: 'Name')
                    ->required()
                    ->native(false),
                Select::make('Open_Emp_Id')
                    ->relationship(name: 'Employee', titleAttribute: 'First_Name')
                    ->required()
                    ->native(false),
                Select::make('Product_Id')
                    ->relationship(name: 'Product', titleAttribute: 'Name')
                    ->required()
                    ->native(false),
                Select::make('User_Id')
                    ->relationship(name: 'User', titleAttribute: 'Name')
                    ->required()
                    ->native(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('Account_Id'),
                TextColumn::make('Last_Activity_Date')
                    ->date(),
                TextColumn::make('Open_Date')
                    ->date(),
                TextColumn::make('Close_Date')
                    ->date(),
                TextColumn::make('Avail_Balance')
                    ->numeric(decimalPlaces: 2)
                    ->money('USD'),
                TextColumn::make('Pending_Balance')
                    ->numeric(decimalPlaces: 2)
                    ->money('USD'),
                TextColumn::make('Status'),
                TextColumn::make('Cust_Id'),
                TextColumn::make('Open_Branch_Id'),
                // ->getStateUsing(fn($record) => $record->Branch::class::Branch_Id::Name),
                TextColumn::make('Open_Emp_Id'),
                TextColumn::make('Product_Id'),
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
            'index' => Pages\ListAccounts::route('/'),
            'create' => Pages\CreateAccount::route('/create'),
            'edit' => Pages\EditAccount::route('/{record}/edit'),
        ];
    }
}
