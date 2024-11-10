<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BusResource\Pages;
use App\Models\Bus;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class BusResource extends Resource
{
    protected static ?string $model = Bus::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';
    protected static ?string $navigationGroup = 'Bus';
    protected static ?string $navigationLabel = 'Bus';

    public static function getGloballySearchableAttributes(): array
    {
        return ['nama_bus', 'plat_nomor', 'tahun', 'sasis', 'karoseri', 'fasilitas', 'kondisi'];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getLabel(): ?string
    {
        return 'Data Bus';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama_bus')
                    ->label('Nama Bus')
                    ->required()
                    ->maxLength(100),

                TextInput::make('plat_nomor')
                    ->label('Plat Nomor')
                    ->unique(ignoreRecord: true)
                    ->required()
                    ->maxLength(20),

                TextInput::make('kapasitas')
                    ->label('Kapasitas')
                    ->placeholder('Jumlah kursi')
                    ->numeric()
                    ->minValue(1)
                    ->required(),

                TextInput::make('tahun')
                    ->label('Tahun')
                    ->numeric()
                    ->minValue(1900)
                    ->maxValue(date('Y'))
                    ->required(),

                TextInput::make('sasis')
                    ->label('Nama Sasis')
                    ->required(),

                TextInput::make('karoseri')
                    ->label('Karoseri')
                    ->nullable()
                    ->maxLength(100),

                TextInput::make('nomor_kir')
                    ->label('Nomor KIR')
                    ->required(),

                Textarea::make('fasilitas')
                    ->label('Fasilitas')
                    ->required(),

                FileUpload::make('foto_bus')
                    ->label('Foto Bus')
                    ->nullable()
                    ->disk('public')
                    ->directory('bus-photos')
                    ->image(),

                Textarea::make('kondisi')
                    ->label('Kondisi')
                    ->required(),

                TextInput::make('harga_sewa')
                    ->label('Harga Sewa')
                    ->numeric()
                    ->minValue(0)
                    ->required()
                    ->placeholder('Masukkan harga sewa per hari atau rute'),

                Select::make('status')
                    ->label('Status')
                    ->options([
                        'Tersedia' => 'Tersedia',
                        'Tidak Tersedia' => 'Tidak Tersedia',
                        'Dalam Perawatan' => 'Dalam Perawatan',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('foto_bus'),
                TextColumn::make('nama_bus')
                    ->label('Nama Bus')
                    ->searchable(),
                TextColumn::make('plat_nomor')
                    ->label('Plat Nomor'),
                TextColumn::make('kapasitas')
                    ->label('Kapasitas'),
                TextColumn::make('tahun')
                    ->label('Tahun'),
                TextColumn::make('sasis')
                    ->label('Nama Sasis'),
                TextColumn::make('karoseri')
                    ->label('Karoseri'),
                TextColumn::make('nomor_kir')
                    ->label('Nomor KIR'),
                TextColumn::make('fasilitas')
                    ->label('Fasilitas'),
                // TextColumn::make('kondisi')
                //     ->label('Kondisi'),
                TextColumn::make('harga_sewa')
                    ->label('Harga Sewa')
                    ->sortable()
                    ->money('IDR', true),
                // TextColumn::make('status')
                //     ->searchable()
                //     ->sortable()
                //     ->label('Status'),
            ])
            ->defaultSort('nama_bus')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListBuses::route('/'),
            'create' => Pages\CreateBus::route('/create'),
            'edit' => Pages\EditBus::route('/{record}/edit'),
        ];
    }
}
