<?php

namespace App\Filament\Resources\SewaResource\Pages;

use App\Filament\Resources\SewaResource;
use App\Models\User;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class CreateSewa extends CreateRecord
{
    protected static string $resource = SewaResource::class;

    protected function save()
    {
        $record = $this->record;

        // Hitung total harga sebelum menyimpan
        if ($record->id_bus && $record->tanggal_mulai && $record->tanggal_selesai) {
            $record->total_harga = SewaResource::calculateTotalPrice(
                $record->id_bus,
                $record->tanggal_mulai,
                $record->tanggal_selesai
            );
        }

        parent::save();
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function beforeCreate(): void
    {
        $user = Auth::user();

        Notification::make()
            ->success()
            ->title('Penyewaan Anda Telah Dibuat')
            ->body('Data penyewaan Anda telah berhasil dibuat.')
            ->sendToDatabase($user)
            // ->actions([
            //     Action::make('Tandai sudah dibaca')
            //         // ->button()
            //         ->markAsRead(),
            //     Action::make('Tandai belum dibaca')
            //         // ->button()
            //         ->markAsUnread(),
            // ])
        ;

        $admins = User::where('role', 'admin')->get();
        foreach ($admins as $admin) {
            Notification::make()
                ->success()
                ->title('Penyewaan Baru Telah Dibuat')
                ->body('Penyewaan baru telah dibuat oleh ' . $user->name . '.')
                ->sendToDatabase($admin);
        }
    }
}
