<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomerResource\Pages;
use App\Models\Customer;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CustomerResource extends Resource
{
    protected static ?string $model = Customer::class;

    protected static ?string $navigationIcon = 'heroicon-c-user-group';

    protected static ?string $navigationGroup = 'Customer';

    protected static ?string $recordTitleAttribute = 'Address';

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
                TextInput::make('Cust_Id')
                    ->numeric()
                    ->label('Customer ID')
                    ->required(),
                TextInput::make('Address')
                    ->maxLength(225),
                TextInput::make('City')
                    ->maxLength(225),
                TextInput::make('Cust_Type_Id')
                    ->label('Customer Type ID')
                    ->required(),
                TextInput::make('Fed_Id')
                    ->required()
                    ->label('Fed ID')
                    ->maxLength(50),
                TextInput::make('Postal_Code')
                    ->label('Postal Code')
                    ->maxLength(50),
                TextInput::make('State')
                    ->maxLength(225),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('Cust_Id')
                    ->label('ID')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('Address')
                    ->sortable()
                    ->limit(40)
                    ->searchable(),
                TextColumn::make('City')
                    ->sortable()
                    ->searchable(),
                // TextColumn::make('Cust_Type_Id')
                //     ->sortable()
                //     ->searchable()
                //     ->label('Cust Type Id'),
                // TextColumn::make('Fed_Id')
                //     ->sortable()
                //     ->searchable()
                //     ->label('Fed ID'),
                TextColumn::make('Postal_Code')
                    ->sortable()
                    ->searchable()
                    ->label('Postal Code'),
                TextColumn::make('State')
                    ->sortable()
                    ->searchable(),
            ])->defaultSort('Cust_Id')
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
            'index' => Pages\ListCustomers::route('/'),
            'create' => Pages\CreateCustomer::route('/create'),
            'edit' => Pages\EditCustomer::route('/{record}/edit'),
        ];
    }
}
