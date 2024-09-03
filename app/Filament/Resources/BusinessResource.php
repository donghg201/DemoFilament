<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BusinessResource\Pages;
use App\Models\Business;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class BusinessResource extends Resource
{
    protected static ?string $model = Business::class;

    protected static ?string $navigationIcon = 'heroicon-s-user-circle';

    protected static ?string $navigationGroup = 'Customer';

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
                TextInput::make('Name')
                    ->maxLength(225)
                    ->required(),
                DatePicker::make('Incorp_Date')
                    ->label('Incorp Date')
                    ->native(false)
                    ->closeOnDateSelection(),
                TextInput::make('State_Id')
                    ->required()
                    ->label('State ID')
                    ->maxLength(50),
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
                TextColumn::make('Name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('Incorp_Date')
                    ->label('Incorp Date')
                    ->sortable()
                    ->date()
                    ->searchable(),
                TextColumn::make('State_Id')
                    ->label('State ID')
                    ->sortable()
                    ->searchable(),
                // TextColumn::make('Cust_Id')
                //     ->sortable()
                //     ->searchable()
                //     ->label('Customer ID'),
            ])->defaultSort('Name')
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
            'index' => Pages\ListBusinesses::route('/'),
            'create' => Pages\CreateBusiness::route('/create'),
            'edit' => Pages\EditBusiness::route('/{record}/edit'),
        ];
    }
}
