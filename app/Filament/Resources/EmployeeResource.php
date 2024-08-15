<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EmployeeResource\Pages;
use App\Models\Employee;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class EmployeeResource extends Resource
{
    protected static ?string $model = Employee::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Employee';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('Emp_Id')
                    ->label('Employee ID')
                    ->required(),
                TextInput::make('Title')
                    ->label('Title'),
                TextInput::make('First_Name')
                    ->label('First Name')
                    ->required(),
                TextInput::make('Last_Name')
                    ->label('Last Name')
                    ->required(),
                DatePicker::make('Start_Date')
                    ->label('Start Date')
                    ->native(false)
                    ->closeOnDateSelection()
                    ->prefix('Starts')
                    ->required(),
                DatePicker::make('End_Date')
                    ->label('End Date')
                    ->native(false)
                    ->closeOnDateSelection()
                    ->prefix('Ends'),

                Select::make('Assigned_Branch_Id')
                    ->label('Branch ID')
                    ->relationship(name: 'Branch', titleAttribute: 'Name')
                    ->required()
                    ->native(false),
                Select::make('Dept_Id')
                    ->label('Department ID')
                    ->relationship(name: 'Department', titleAttribute: 'Name')
                    ->required()
                    ->native(false),
                TextInput::make('Superior_Emp_Id')
                    ->label('Superior Employee ID'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('Emp_Id')
                    ->label('ID'),
                TextColumn::make('First_Name')
                    ->label('First Name'),
                TextColumn::make('Last_Name')
                    ->label('Last Name'),
                TextColumn::make('Start_Date')
                    ->label('Start Date')
                    ->date(),
                TextColumn::make('End_Date')
                    ->label('End Date')
                    ->date(),
                TextColumn::make('Title')
                    ->label('Title'),
                TextColumn::make('Assigned_Branch_Id')
                    ->label('Branch ID'),
                TextColumn::make('Dept_Id')
                    ->label('Dept ID'),
                TextColumn::make('Superior_Emp_Id')
                    ->label('Superior ID'),
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
            'index' => Pages\ListEmployees::route('/'),
            'create' => Pages\CreateEmployee::route('/create'),
            'edit' => Pages\EditEmployee::route('/{record}/edit'),
        ];
    }
}
