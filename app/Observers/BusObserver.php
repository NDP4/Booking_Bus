<?php

namespace App\Observers;

use App\Models\Bus;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Filament\Notifications\Notification;

class BusObserver
{
    //
    public function created(Bus $bus): void
    {
        $user = Auth::user();

        if ($user) {
            $name = $user->name;

            Notification::make()
                ->success()
                ->title('Ditambahkan baru oleh ' . $name)
                ->body('Bus baru ditambahkan')
                ->sendToDatabase(User::where('id', $user->id)->get());
        }
    }
}
