<?php

namespace App\Filament\Resources;

use App\Filament\Exports\SewaExporter;
use App\Filament\Resources\SewaResource\Pages;
use App\Models\Sewa;
use App\Models\Bus;
use Carbon\Carbon;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Filament\Notifications\Notification;
use App\Models\User;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\ToggleButtons;
use Filament\Tables\Actions\ExportAction;
use Filament\Tables\Actions\ExportBulkAction;
use Filament\Tables\Enums\ActionsPosition;

class SewaResource extends Resource
{
    protected static ?string $model = Sewa::class;
    protected static ?string $navigationIcon = 'heroicon-o-calendar';
    protected static ?string $activeNavigationIcon = 'heroicon-s-calendar';
    protected static ?string $navigationLabel = 'Sewa';
    protected static ?string $navigationGroup = 'Sewa';
    public static function getGloballySearchableAttributes(): array
    {
        return ['jam_penjemputan', 'tanggal_mulai', 'tanggal_selesai', 'lokasi_penjemputan', 'tujuan'];
    }
    public static function getLabel(): ?string
    {
        return 'Sewa';
    }
    public static function form(Form $form): Form
    {
        $userRole = Auth::user()->role;
        return $form
            ->schema([
                Split::make([
                    Section::make([
                        Select::make('id_penyewa')
                            ->label('Penyewa')
                            ->relationship('penyewa', 'name')
                            ->searchable()
                            ->default(Auth::user()->id)
                            ->required()
                            ->disabled(),
                        Select::make('id_bus')
                            ->label('Bus')
                            ->relationship('bus', 'nama_bus')
                            ->searchable()
                            ->required()
                            ->reactive()
                            ->options(function () {
                                return Bus::pluck('nama_bus', 'id')->toArray();
                            })
                            ->afterStateUpdated(function ($state, callable $set, $get) {
                                $tanggalMulai = $get('tanggal_mulai');
                                $tanggalSelesai = $get('tanggal_selesai');
                                if ($tanggalMulai && $tanggalSelesai) {
                                    $set('total_harga', static::calculateTotalPrice($state, $tanggalMulai, $tanggalSelesai));
                                }
                                $startDate = $get('tanggal_mulai');
                                $endDate = $get('tanggal_selesai');
                                // Validasi tumpang tindih sewa bus
                                if ($startDate && $endDate) {
                                    try {
                                        Sewa::validateBusAvailability($state, $startDate, $endDate);
                                    } catch (\Exception $e) {
                                        // Mengirimkan notifikasi kepada pengguna terkait
                                        $user = Auth::user();  // Mendapatkan pengguna yang sedang login
                                        Notification::make()
                                            ->error()  // Error karena tumpang tindih
                                            ->title('Peringatan: Bus Tidak Tersedia')
                                            ->body('Bus sudah dipesan pada periode waktu yang sama.')
                                            ->actions([
                                                Action::make('Tandai Sudah Dibaca')  // Menjadikan aksi ini sebagai tombol
                                                    ->markAsRead() // Tandai notifikasi sebagai sudah dibaca
                                            ])
                                            ->toDatabase() // Simpan notifikasi ke database
                                            ->sendToDatabase(User::whereIn('role', ['admin', 'konsumen'])->get()); // Mengirim notifikasi ke admin dan konsumen
                                        // Clear input jika terjadi tumpang tindih
                                        $set('id_bus', null);
                                        $set('total_harga', null);

                                        throw new \Exception($e->getMessage()); // Menampilkan pesan error
                                    }
                                }
                            }),
                        MarkdownEditor::make('lokasi_penjemputan')
                            ->label('Lokasi Penjemputan')
                            ->required(),
                        MarkdownEditor::make('tujuan')
                            ->label('Tujuan')
                            ->required(),
                    ])
                        ->columnSpan(2),
                    Section::make([
                        DatePicker::make('tanggal_mulai')
                            ->label('Tanggal Mulai')
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set, $get) {
                                $busId = $get('id_bus');
                                $tanggalSelesai = $get('tanggal_selesai');
                                if ($busId && $tanggalSelesai) {
                                    $set('total_harga', static::calculateTotalPrice($busId, $state, $tanggalSelesai));
                                }

                                $busId = $get('id_bus');
                                $tanggalSelesai = $get('tanggal_selesai');
                                if ($busId && $tanggalSelesai) {
                                    try {
                                        Sewa::validateBusAvailability($busId, $state, $tanggalSelesai);
                                    } catch (\Exception $e) {
                                        $set('id_bus', null);
                                        $set('total_harga', null);
                                        throw new \Exception($e->getMessage());
                                    }
                                }
                            })
                            ->rule('after_or_equal:today'),
                        DatePicker::make('tanggal_selesai')
                            ->label('Tanggal Selesai')
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set, $get) {
                                $busId = $get('id_bus');
                                $tanggalMulai = $get('tanggal_mulai');
                                if ($busId && $tanggalMulai) {
                                    $set('total_harga', static::calculateTotalPrice($busId, $tanggalMulai, $state));
                                }
                            })
                            ->rule('after_or_equal:tanggal_mulai')
                            ->rule('after_or_equal:today'),
                        TimePicker::make('jam_penjemputan')
                            ->label('Jam Penjemputan')
                            ->required(),
                        TextInput::make('total_harga')
                            ->label('Total Harga')
                            ->required() // Pastikan field ini wajib diisi
                            ->numeric(),
                        ToggleButtons::make('status')
                            ->label('Status')
                            ->options([
                                'Diproses' => 'Diproses',
                                'Berlangsung' => 'Berlangsung',
                                'Selesai' => 'Selesai',
                                'Dibatalkan' => 'Dibatalkan',
                            ])
                            ->colors([
                                'Diproses' => 'warning',
                                'Berlangsung' => 'info',
                                'Selesai' => 'success',
                                'Dibatalkan' => 'danger',
                            ])
                            ->default('Diproses')
                            ->required()
                            ->disabled($userRole === 'konsumen'),
                    ])
                        ->grow(false),
                ])
                    ->from('sm'),
            ])
            ->columns(1);
    }
    // Fungsi kalkulasi total harga
    public static function calculateTotalPrice($busId, $startDate, $endDate)
    {
        $bus = Bus::find($busId);
        if (!$bus || !$bus->harga_sewa) {
            return 0;
        }
        $start = Carbon::parse($startDate);
        $end = Carbon::parse($endDate);

        // Menghitung durasi hari
        $durasi = $start->isSameDay($end) ? 1 : $start->diffInDays($end) + 1;

        return $bus->harga_sewa * $durasi;
    }
    protected function beforeSave($record)
    {
        $bus = Bus::find($record->id_bus);
        if ($bus) {
            if ($bus->status === 'Tidak Tersedia') {
                throw new \Exception("Bus sedang dalam masa sewa. Tidak dapat di sewa lagi.");
            }
            Log::info('Bus ID: ' . $bus->id . ' - Status: ' . $bus->status);
        }
        $bus->status = 'Tidak Tersedia';
        $bus->save();
        $record->id_penyewa = Auth::id();
        if ($record->id_bus && $record->tanggal_mulai && $record->tanggal_selesai) {
            $totalHarga = static::calculateTotalPrice(
                $record->id_bus,
                $record->tanggal_mulai,
                $record->tanggal_selesai
            );
            if ($totalHarga <= 0) {
                throw new \Exception("Total harga harus lebih dari 0.");
            }
            $record->total_harga = $totalHarga;
        }
    }
    public static function updateBusStatus()
    {
        Log::info('Updating bus status...');
        $buses = Bus::where('status', 'Tidak Tersedia')->get();
        foreach ($buses as $bus) {
            $rentals = Sewa::where('id_bus', $bus->id)->where('tanggal_selesai', '<=', now())->get();
            if ($rentals->count() === 0) {
                $bus->status = 'Tersedia';
                $bus->save();
                Log::info('Bus ID: ' . $bus->id . ' status updated to Tersedia');
            }
        }
    }
    public static function table(Tables\Table $table): Tables\Table
    {
        $userId = Auth::id();
        $userRole = Auth::user()->role;
        $query = Sewa::query();
        if ($userRole === 'konsumen') {
            $query->where('id_penyewa', $userId);
        }
        return $table
            ->query($query)
            ->columns([
                TextColumn::make('id')
                    ->label('id sewa')
                    ->sortable()
                    ->searchable()
                    ->formatStateUsing(function ($record) {
                        return 'RP' . $record->id;
                    }),
                TextColumn::make('penyewa.name')
                    ->label('Penyewa')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('bus.nama_bus')->label('Bus')->sortable()->searchable(),
                TextColumn::make('tanggal_mulai')->label('Tanggal')->sortable()->searchable()->description(fn(Sewa $records): string => $records->tanggal_selesai),
                // TextColumn::make('tanggal_mulai')->label('Tanggal Mulai')->date()->sortable(),
                // TextColumn::make('tanggal_selesai')->label('Tanggal Selesai')->date()->sortable(),
                TextColumn::make('jam_penjemputan')->label('Waktu dan lokasi penjemputan')->time()->copyable()->sortable()->searchable()->description(fn(Sewa $records): string => $records->lokasi_penjemputan),
                // TextColumn::make('lokasi_penjemputan')->label('Lokasi Penjemputan'),
                TextColumn::make('tujuan')->label('Tujuan'),
                TextColumn::make('status')->label('Status')->badge(),
                TextColumn::make('total_harga')->label('Total Harga')->money('IDR', true),
            ])
            ->defaultSort('tanggal_mulai')
            ->actions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    DeleteAction::make(),
                ])
                    ->tooltip('Actions'),
                Action::make('pay')
                    ->label('Bayar')
                    ->color('success')
                    ->icon('heroicon-o-credit-card')
                    ->url(fn(Sewa $record) => route('sewa.pay', $record->id)), // route laravel
                // ->url(fn(Sewa $record) => route('payment.show', $record->id)), // route react
            ], position: ActionsPosition::BeforeCells)
            ->headerActions([
                ExportAction::make()->exporter(SewaExporter::class)
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
                ExportBulkAction::make()->exporter(SewaExporter::class)
            ]);
    }
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSewas::route('/'),
            'create' => Pages\CreateSewa::route('/create'),
            'edit' => Pages\EditSewa::route('/{record}/edit'),
        ];
    }
}
