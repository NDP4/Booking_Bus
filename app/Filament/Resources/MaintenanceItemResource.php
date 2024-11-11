<?php

namespace App\Filament\Resources;

use App\Filament\Exports\MaintenanceItemExporter;
use App\Filament\Resources\MaintenanceItemResource\Pages;
use App\Filament\Resources\MaintenanceItemResource\RelationManagers;
use App\Models\maintenance_item;
use App\Models\MaintenanceItem;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ExportAction;
use Filament\Tables\Actions\ExportBulkAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Enums\ActionsPosition;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MaintenanceItemResource extends Resource
{
    protected static ?string $model = maintenance_item::class;
    protected static ?string $navigationIcon = 'heroicon-o-wrench';
    protected static ?string $activeNavigationIcon = 'heroicon-s-wrench';
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
                Split::make([
                    Section::make([
                        Select::make('maintenance_id')
                            ->label('Maintenance')
                            ->relationship('maintenance', 'deskripsi')
                            ->native(false)
                            ->required(),
                        TextInput::make('nama_item')
                            ->label('Nama Item')
                            ->maxLength(255)
                            ->required(),
                    ])
                        ->columnSpan(2),
                    Section::make([
                        TextInput::make('biaya')
                            ->label('Biaya')
                            ->numeric()
                            ->required(),
                    ])
                        ->grow(false),
                ])
                    ->from('sm'),
            ])
            ->columns(1);
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
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    DeleteAction::make(),
                ])
                    ->tooltip('Actions'),
            ], position: ActionsPosition::BeforeCells)
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
        ];
    }
}
