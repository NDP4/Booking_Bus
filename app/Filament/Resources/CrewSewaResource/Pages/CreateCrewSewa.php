<?php

namespace App\Filament\Resources\CrewSewaResource\Pages;

use App\Filament\Resources\CrewSewaResource;
use App\Models\CrewSewa;
use App\Models\Sewa;
use App\Models\User;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateCrewSewa extends CreateRecord
{
    protected static string $resource = CrewSewaResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    // Setelah data crew ditugaskan, kirim notifikasi kepada konsumen dan crew
    protected function afterCreate(): void
    {
        // Ambil record CrewSewa yang baru saja dibuat
        $crewSewa = $this->record;

        // Dapatkan ID Sewa dan Crew dari record
        $sewaId = $crewSewa->sewa_id;
        $crewId = $crewSewa->crew_id;

        // Cari data Sewa terkait
        $sewa = Sewa::find($sewaId);

        // Pastikan sewa ditemukan dan memiliki penyewa
        if ($sewa && $sewa->id_penyewa) {
            $penyewaId = $sewa->id_penyewa;

            // Kirim notifikasi ke konsumen (penyewa)
            $penyewa = User::find($penyewaId);
            if ($penyewa) {
                // Ambil nama dan nomor telepon crew
                $crew = User::find($crewId);
                if ($crew) {
                    $crewName = $crew->name;
                    $crewPhone = $crew->phone_number; // Pastikan kolom 'phone' ada pada tabel users

                    Notification::make()
                        ->success()
                        ->title('Penugasan Crew Terkait Penyewaan Anda')
                        ->body('Crew baru telah ditugaskan untuk melayani penyewaan Anda dengan ID Sewa: RP' . $sewaId . '. Crew: ' . $crewName . '. Nomor Telepon: ' . $crewPhone)
                        ->sendToDatabase($penyewa);
                }
            }

            // Kirim notifikasi ke crew yang ditugaskan
            $crew = User::find($crewId);
            if ($crew) {
                $crewName = $crew->name;
                $crewPhone = $crew->phone; // Pastikan kolom 'phone' ada pada tabel users

                Notification::make()
                    ->success()
                    ->title('Anda Telah Ditugaskan untuk Penyewaan')
                    ->body('Anda telah ditugaskan untuk melayani penyewaan dengan ID Sewa: RP' . $sewaId . '. Nama Anda: ' . $crewName . '. Nomor Telepon: ' . $crewPhone)
                    ->sendToDatabase($crew);
            }
        }
    }
}
