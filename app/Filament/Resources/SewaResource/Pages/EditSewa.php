<?php

namespace App\Filament\Resources\SewaResource\Pages;

use App\Filament\Resources\SewaResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Notifications\Actions\Action;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class EditSewa extends EditRecord
{
    protected static string $resource = SewaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    // protected function beforeSave(): void
    // {
    //     Notification::make()
    //         ->title('Edit Record')
    //         ->sendToDatabase(Auth::user());
    // }

    protected function beforeSave(): void
    {
        $record = $this->record;

        $consumerUserId = $record->id_penyewa;

        $consumer = User::find($consumerUserId);

        if ($consumer) {
            Notification::make()
                ->warning()
                ->title('Status sewa Anda telah diperbarui')
                ->body('Admin telah memperbarui status sewa Anda.')
                ->actions([
                    Action::make('Tandai sudah dibaca')
                        // ->button()
                        ->markAsRead(),
                    Action::make('Tandai belum dibaca')
                        // ->button()
                        ->markAsUnread(),
                ])
                ->sendToDatabase($consumer);
        }
    }
}
