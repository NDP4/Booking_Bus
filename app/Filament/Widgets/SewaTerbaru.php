<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\SewaResource;
use App\Models\Sewa;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\Action;

class SewaTerbaru extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';

    protected static ?int $sort = 2;

    public function table(Table $table): Table
    {
        return $table

            ->query(Sewa::query())

            ->defaultPaginationPageOption(5)

            ->defaultSort('tanggal_mulai', 'desc')
            ->columns([

                Tables\Columns\TextColumn::make('tanggal_mulai')
                    ->label('Tanggal Mulai')
                    ->date()
                    ->sortable(),

                Tables\Columns\TextColumn::make('id')
                    ->label('ID Sewa')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('penyewa.name')
                    ->label('Nama Penyewa')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->sortable(),

                Tables\Columns\TextColumn::make('total_harga')
                    ->label('Total Harga')
                    ->searchable()
                    ->sortable()
                    ->money('IDR', true),

                Tables\Columns\TextColumn::make('lama_sewa')
                    ->label('Durasi Sewa (Hari)')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('lokasi_penjemputan')
                    ->label('Lokasi Penjemputan')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('tujuan')
                    ->label('Tujuan')
                    ->searchable()
                    ->sortable(),
            ])
            ->actions([
                Tables\Actions\Action::make('open')

                    ->url(fn(Sewa $record): string => SewaResource::getUrl('edit', ['record' => $record->id]))
                    ->icon('heroicon-o-eye')
                    ->label('Buka'),
            ]);
    }
}
