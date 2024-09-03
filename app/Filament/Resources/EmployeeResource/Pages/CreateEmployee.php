<?php

namespace App\Filament\Resources\EmployeeResource\Pages;

use App\Filament\Resources\EmployeeResource;
use App\Models\Employee;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;
use Filament\Notifications\Actions\Action;

class CreateEmployee extends CreateRecord
{
    protected static string $resource = EmployeeResource::class;

    public function handle(Employee $emp): Employee
    {
        return $emp;
    }

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->title('Created successfully')
            ->success()
            ->body('Changes to the post have been saved.')
            ->actions([
                Action::make('view')
                    ->button(),
                Action::make('undo')
                    ->color('gray'),
            ])
            ->send();
    }
}
