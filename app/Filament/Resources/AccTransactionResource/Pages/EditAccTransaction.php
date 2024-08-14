<?php

namespace App\Filament\Resources\AccTransactionResource\Pages;

use App\Filament\Resources\AccTransactionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAccTransaction extends EditRecord
{
    protected static string $resource = AccTransactionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
