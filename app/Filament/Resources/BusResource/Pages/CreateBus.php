<?php

namespace App\Filament\Resources\BusResource\Pages;

use App\Filament\Resources\BusResource;
use Illuminate\Support\Facades\Auth;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Actions\Action;
use App\Models\User;

class CreateBus extends CreateRecord
{
    protected static string $resource = BusResource::class;

    // protected function created(): void
    // {
    //     // Mendapatkan informasi user yang membuat entitas
    //     $user = Auth::user();
    //     $userName = $user->name;
    //     $createdBusId = $this->record->id; // ID dari bus yang baru dibuat
    //     $busDetails = $this->record->toArray(); // Detail dari bus yang baru dibuat

    //     // Mendapatkan pengguna dengan role 'crew' dan 'konsumen'
    //     $usersToNotify = User::whereIn('role', ['crew', 'konsumen'])->get();

    //     // Mengirim notifikasi ke setiap pengguna yang relevan
    //     foreach ($usersToNotify as $userToNotify) {
    //         $userToNotify->notify(
    //             Notification::make()
    //                 ->success()
    //                 ->title('Ditambahkan baru oleh ' . $userName)
    //                 ->body('Bus baru ditambahkan dengan ID: ' . $createdBusId . '. Detail: ' . json_encode($busDetails))
    //                 ->toDatabase() // Mengubah ke format database
    //         );
    //     }
    // }

    protected function getRedirectUrl(): string
    {
        // $user = Auth::user();

        // if ($user) {
        //     $name = $user->name;

        //     Notification::make()
        //         ->success()
        //         ->title('Ditambahkan baru oleh ' . $name)
        //         ->body('Bus baru ditambahkan')
        //         ->sendToDatabase(User::where('id', $user->id)->get());
        // }

        return $this->getResource()::getUrl('index');
    }

    protected function beforeCreate(): void
    {
        $users = User::whereIn('role', ['konsumen', 'crew'])->get();

        foreach ($users as $user) {
            Notification::make()
                ->success()
                ->title('Bus baru telah bertambah')
                ->icon('heroicon-o-check-circle')
                ->body('Admin telah menambahkan bus baru')
                ->actions([
                    Action::make('Tandai sudah dibaca')
                        // ->button()
                        ->markAsRead(),
                    Action::make('Tandai belum dibaca')
                        // ->button()
                        ->markAsUnread(),
                ])
                ->sendToDatabase($user);
        }
    }
}
