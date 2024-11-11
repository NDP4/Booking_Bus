<?php

namespace App\Filament\Resources;

use App\Filament\Exports\SewaCrewExporter;
use App\Filament\Resources\CrewSewaResource\Pages;
use App\Filament\Resources\CrewSewaResource\RelationManagers;
use App\Models\CrewSewa;
use App\Models\Sewa;
use App\Models\sewa_crew;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Split;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ExportAction;
use Filament\Tables\Actions\ExportBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CrewSewaResource extends Resource
{
    protected static ?string $model = sewa_crew::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';
    protected static ?string $navigationLabel = 'Penugasan Crew';

    public static function getGloballySearchableAttributes(): array
    {
        return ['sewa_id', 'crew_id'];
    }
    public static function getLabel(): ?string
    {
        return 'Penugasan Crew';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Split::make([


                Forms\Components\Select::make('sewa_id')
                    ->relationship('sewa', 'id')
                    ->label('ID Sewa')
                    ->required()
                    ->options(
                        Sewa::all()->pluck('id')->mapWithKeys(function ($id) {
                            return [
                                $id => 'RP' . $id
                            ];
                        })
                    ),
                Forms\Components\Select::make('crew_id')
                    ->label('Nama Crew')
                    ->required()
                    ->options(User::crew()->pluck('name', 'id'))

                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('sewa.id')
                    ->label('ID Sewa')
                    ->formatStateUsing(function ($record) {
                        return 'RP' . $record->sewa->id;
                    }),
                TextColumn::make('sewa.tanggal_mulai')->label('Keberangkatan')->sortable()->searchable()->description(fn($record): string => 'Penjemputan ' . $record->sewa->lokasi_penjemputan),
                TextColumn::make('sewa.tujuan')->label('Tujuan')->sortable()->searchable(),
                TextColumn::make('crew.name')
                    ->label('Nama Crew')
                    ->searchable(),
                TextColumn::make('crew.phone_number')
                    ->label('Telp Crew')
                    // ->copyable()
                    ->searchable()
                    ->formatStateUsing(
                        fn($state) =>
                        'https://wa.me/' . preg_replace('/^0/', '62', $state)
                    )
                    ->url(fn($record) => 'https://wa.me/' . preg_replace('/^0/', '62', $record->crew->phone_number))
                    ->wrap()
                    ->extraAttributes(['target' => '_blank'])
                    ->label('Hubungi via WhatsApp')
                    ->icon('heroicon-o-phone')
                    ->color('success'),



                TextColumn::make('created_at')
                    ->label('Ditugaskan Pada')->dateTime(),
            ])
            ->filters([
                //
            ])

            ->headerActions([
                ExportAction::make()->exporter(SewaCrewExporter::class)
            ])

            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
                ExportBulkAction::make()->exporter(SewaCrewExporter::class)
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
            'index' => Pages\ListCrewSewas::route('/'),
        ];
    }
}
