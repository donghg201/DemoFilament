<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EmployeeResource\Pages;
use App\Models\Employee;
use Illuminate\Support\Carbon;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class EmployeeResource extends Resource
{
    protected static ?string $model = Employee::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    protected static ?string $navigationGroup = 'Employee';

    protected static ?string $recordTitleAttribute = 'First_Name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('Emp_Id')
                    ->numeric()
                    ->label('Employee ID')
                    ->required(),
                TextInput::make('Title')
                    ->label('Title')
                    ->maxLength(225),
                TextInput::make('First_Name')
                    ->label('First Name')
                    ->required()
                    ->maxLength(225),
                TextInput::make('Last_Name')
                    ->label('Last Name')
                    ->required()
                    ->maxLength(225),
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
                    ->native(false)
                    ->searchable()
                    ->preload(),
                Select::make('Dept_Id')
                    ->label('Department ID')
                    ->relationship(name: 'Department', titleAttribute: 'Name')
                    ->required()
                    ->native(false)
                    ->searchable()
                    ->preload(),
                TextInput::make('Superior_Emp_Id')
                    ->label('Superior Employee ID'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('Emp_Id')
                    ->label('ID')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('First_Name')
                    ->label('First Name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('Last_Name')
                    ->label('Last Name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('Start_Date')
                    ->label('Start Date')
                    ->date()
                    ->searchable()
                    ->sortable(),
                TextColumn::make('End_Date')
                    ->label('End Date')
                    ->date()
                    ->searchable()
                    ->sortable(),
                TextColumn::make('Title')
                    ->label('Title')
                    ->sortable()
                    ->searchable()
                    ->limit(40),
                // TextColumn::make('Assigned_Branch_Id')
                //     ->label('Branch ID')
                //     ->sortable()
                //     ->searchable(),
                // TextColumn::make('Dept_Id')
                //     ->label('Dept ID')
                //     ->sortable()
                //     ->searchable(),
                // TextColumn::make('Superior_Emp_Id')
                //     ->label('Superior ID')
                //     ->sortable()
                //     ->searchable(),
            ])->defaultSort('Emp_Id')
            ->filters([
                SelectFilter::make('Branch')
                    ->relationship('branch', 'Name')
                    ->searchable()
                    ->preload()
                    ->label('Filter by Branch')
                    ->indicator('Branch'),
                Filter::make('Start_Date')
                    ->form([
                        DatePicker::make('created_from')
                            ->date(),
                        DatePicker::make('created_until')
                            ->date(),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn(Builder $query, $date): Builder => $query->whereDate('Start_Date', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn(Builder $query, $date): Builder => $query->whereDate('Start_Date', '<=', $date),
                            );
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];
                        if ($data['created_from'] ?? null) {
                            $indicators['created_from'] = 'Created from ' . Carbon::parse($data['created_from'])->toFormattedDateString();
                        }
                        if ($data['created_until'] ?? null) {
                            $indicators['created_until'] = 'Created until ' . Carbon::parse($data['created_until'])->toFormattedDateString();
                        }
                        return $indicators;
                    }),
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
            'index' => Pages\ListEmployees::route('/'),
            'create' => Pages\CreateEmployee::route('/create'),
            'edit' => Pages\EditEmployee::route('/{record}/edit'),
        ];
    }
}
