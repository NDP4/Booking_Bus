<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PenilaianResource\Pages;
use App\Filament\Resources\PenilaianResource\RelationManagers;
use App\Models\Penilaian;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class PenilaianResource extends Resource
{
    protected static ?string $model = Penilaian::class;

    protected static ?string $navigationIcon = 'heroicon-o-star';
    protected static ?string $navigationGroup = 'Sewa';
    public static function getGloballySearchableAttributes(): array
    {
        return ['ulasan', 'rating'];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getLabel(): ?string
    {
        return 'Penilaian';
    }

    public static function form(Form $form): Form
    {
        $userId = Auth::id();

        return $form
            ->schema([
                Forms\Components\Select::make('sewa_id')
                    ->label('ID Sewa')
                    ->searchable()
                    ->placeholder('Pilih Atau Masukkan ID sewa anda')
                    ->relationship('sewa', 'id')
                    ->required()
                    ->preload()
                    ->options(function () use ($userId) {
                        return \App\Models\Sewa::where('id_penyewa', $userId)->pluck('id', 'id');
                    })
                    ->reactive()
                    ->afterStateUpdated(function (callable $set, $state) use ($userId) {
                        $existingPenilaian = Penilaian::where('sewa_id', $state)
                            ->where('penyewa_id', $userId)
                            ->exists();

                        if ($existingPenilaian) {
                            $set('sewa_id', null);
                            throw new \Exception('Penilaian untuk sewa ini sudah ada.');
                        }
                    }),
                Forms\Components\Hidden::make('penyewa_id')
                    ->default($userId),
                Forms\Components\TextInput::make('rating')
                    ->label('Rating')
                    ->required()
                    ->numeric()
                    ->placeholder('1 - 5')
                    ->minValue(1)
                    ->maxValue(5),
                Forms\Components\Textarea::make('ulasan')
                    ->label('Ulasan')
                    ->placeholder('Ulasan anda sangat berarti bagi kami')
                    ->nullable(),
            ]);
    }

    protected static function afterCreate($record): void
    {
        $existingPenilaian = Penilaian::where('sewa_id', $record->sewa_id)
            ->where('penyewa_id', $record->penyewa_id)
            ->exists();

        if ($existingPenilaian) {
            throw new \Exception('Penilaian untuk sewa ini sudah ada.');
        }
    }






    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('sewa.bus.nama_bus')
                    ->label('Nama Bus')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('pengguna.name')
                    ->label('Nama Penyewa'), // Menampilkan Nama Penyewa
                TextColumn::make('rating')
                    ->label('Rating'),
                TextColumn::make('ulasan')
                    ->label('Ulasan'),
                TextColumn::make('created_at')
                    ->label('dibuat pada')
                    ->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListPenilaians::route('/'),
            'create' => Pages\CreatePenilaian::route('/create'),
            'edit' => Pages\EditPenilaian::route('/{record}/edit'),
        ];
    }
}
