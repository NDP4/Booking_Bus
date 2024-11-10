<?php

namespace App\Filament\Resources;

use App\Filament\Exports\MaintenanceItemExporter;
use App\Filament\Resources\MaintenanceItemResource\Pages;
use App\Filament\Resources\MaintenanceItemResource\RelationManagers;
use App\Models\maintenance_item;
use App\Models\MaintenanceItem;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ExportAction;
use Filament\Tables\Actions\ExportBulkAction;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MaintenanceItemResource extends Resource
{
    protected static ?string $model = maintenance_item::class;

    protected static ?string $navigationIcon = 'heroicon-o-wrench';
    protected static ?string $navigationLabel = 'Item Maintenance';
    protected static ?string $navigationGroup = 'Bus';

    public static function getLabel(): ?string
    {
        return 'Item Maintenance';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Forms\Components\Select::make('maintenance_id')
                    ->label('Maintenance')
                    ->relationship('maintenance', 'deskripsi')
                    ->required(),
                Forms\Components\TextInput::make('nama_item')
                    ->label('Nama Item')
                    ->maxLength(255)
                    ->required(),
                Forms\Components\TextInput::make('biaya')
                    ->label('Biaya')
                    ->numeric()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('maintenance.id')
                    ->label('No Maintenance')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama_item')
                    ->label('Nama Item')
                    ->searchable(),
                Tables\Columns\TextColumn::make('biaya')
                    ->label('Biaya')
                    ->searchable()
                    ->money('IDR', true), // Format dalam Rupiah
                Tables\Columns\TextColumn::make('created_at')->label('Dibuat pada')->dateTime(),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->headerActions([
                ExportAction::make()->exporter(MaintenanceItemExporter::class)
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
                ExportBulkAction::make()->exporter(MaintenanceItemExporter::class)
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
            'index' => Pages\ListMaintenanceItems::route('/'),
            'create' => Pages\CreateMaintenanceItem::route('/create'),
            'edit' => Pages\EditMaintenanceItem::route('/{record}/edit'),
        ];
    }
}
