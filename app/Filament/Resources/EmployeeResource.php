<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EmployeeResource\Pages;
use App\Filament\Resources\EmployeeResource\RelationManagers\BranchRelationManager;
use App\Filament\Resources\EmployeeResource\RelationManagers\DepartmentRelationManager;
use App\Models\Employee;
use Illuminate\Support\Carbon;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Form;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class EmployeeResource extends Resource
{
    protected static ?string $model = Employee::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    protected static ?string $navigationGroup = 'Employee';

    protected static ?string $recordTitleAttribute = 'First_Name';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        return 'info';
    }

    // public static function form(Form $form): Form
    // {
    //     return $form
    //         ->schema([
    //             TextInput::make('Emp_Id')
    //                 ->numeric()
    //                 ->label('Employee ID')
    //                 ->required(),
    //             TextInput::make('Title')
    //                 ->label('Title')
    //                 ->maxLength(225),
    //             TextInput::make('First_Name')
    //                 ->label('First Name')
    //                 ->required()
    //                 ->maxLength(225),
    //             TextInput::make('Last_Name')
    //                 ->label('Last Name')
    //                 ->required()
    //                 ->maxLength(225),
    //             DatePicker::make('Start_Date')
    //                 ->label('Start Date')
    //                 ->native(false)
    //                 ->closeOnDateSelection()
    //                 ->prefix('Starts')
    //                 ->required(),
    //             DatePicker::make('End_Date')
    //                 ->label('End Date')
    //                 ->native(false)
    //                 ->closeOnDateSelection()
    //                 ->prefix('Ends'),
    //             Select::make('Assigned_Branch_Id')
    //                 ->label('Branch ID')
    //                 ->relationship(name: 'Branch', titleAttribute: 'Name')
    //                 ->required()
    //                 ->native(false)
    //                 ->searchable()
    //                 ->preload(),
    //             Select::make('Dept_Id')
    //                 ->label('Department ID')
    //                 ->relationship(name: 'Department', titleAttribute: 'Name')
    //                 ->required()
    //                 ->native(false)
    //                 ->searchable()
    //                 ->preload(),
    //             TextInput::make('Superior_Emp_Id')
    //                 ->label('Superior Employee ID'),
    //         ]);
    // }

    public static function form(Form $form): Form
    {
        return $form
            ->schema(
                [
                    Section::make('Employee Details')
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
                        ])->columnSpan(2)->columns(2),

                    Section::make('Time Modified')
                        ->schema([
                            Placeholder::make('created_at')
                                ->label('Created At')
                                ->content(fn(Employee $emp): ?string => $emp->created_at?->isoFormat('LL')),
                            Placeholder::make('updated_at')
                                ->label('Updated At')
                                ->content(fn(Employee $emp): ?string => $emp->updated_at?->isoFormat('LL')),
                        ])
                        ->hidden(fn(string $operation): bool => $operation === 'create')
                        ->columnSpan(1),

                    Section::make('Date')
                        ->schema([
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
                        ])->columnSpan(2),
                    // Section::make('Relation')
                    //     ->schema([
                    //         Select::make('Assigned_Branch_Id')
                    //             ->label('Branch ID')
                    //             ->relationship(name: 'Branch', titleAttribute: 'Name')
                    //             ->required()
                    //             ->native(false)
                    //             ->searchable()
                    //             ->preload(),
                    //         Select::make('Dept_Id')
                    //             ->label('Department ID')
                    //             ->relationship(name: 'Department', titleAttribute: 'Name')
                    //             ->required()
                    //             ->native(false)
                    //             ->searchable()
                    //             ->preload(),
                    //         TextInput::make('Superior_Emp_Id')
                    //             ->label('Superior Employee ID'),
                    //     ])->columnSpan(2)->columns(2),
                ]
            )->columns([
                'default' => 1,
                'md' => 1,
                'lg' => 2,
                'xl' => 2,
                '2xl' => 3,
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
            BranchRelationManager::class,
            DepartmentRelationManager::class,
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
