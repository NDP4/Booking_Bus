<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DokumentasiKerusakanResource\Pages;
use App\Filament\Resources\DokumentasiKerusakanResource\RelationManagers;
use App\Models\dokumentasi_kerusakan;
use App\Models\DokumentasiKerusakan;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ExportAction;
use Filament\Tables\Actions\ExportBulkAction;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Exports\DokumentasiKerusakanExporter;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Tables\Enums\ActionsPosition;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DokumentasiKerusakanResource extends Resource
{
    protected static ?string $model = dokumentasi_kerusakan::class;

    protected static ?string $navigationIcon = 'heroicon-o-camera';
    protected static ?string $activeNavigationIcon = 'heroicon-s-camera';

    protected static ?string $navigationLabel = 'Dokumentasi Kerusakan';
    public static function getLabel(): ?string
    {
        return 'Dokumentasi Kerusakan';
    }
    protected static ?string $navigationGroup = 'Bus';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Select::make('maintenance_id')
                    ->relationship('maintenance', 'id')
                    ->label('Maintenance')
                    ->required(),
                FileUpload::make('foto')
                    ->label('Foto')
                    ->image()
                    ->directory('uploads/dokumentasi_kerusakan')
                    ->required(),
                MarkdownEditor::make('deskripsi')
                    ->label('Deskripsi')
                    ->required(),
            ])
            ->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('maintenance.id')->label('Maintenance ID'),
                Tables\Columns\ImageColumn::make('foto')->label('Foto'),
                Tables\Columns\TextColumn::make('deskripsi')->label('Deskripsi')->limit(50),
                Tables\Columns\TextColumn::make('created_at')->label('Dibuat Pada')->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    EditAction::make(),
                ])
                    ->tooltip('Actions'),
            ], position: ActionsPosition::BeforeCells)
            ->headerActions([
                ExportAction::make()->exporter(DokumentasiKerusakanExporter::class)
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
                ExportBulkAction::make()->exporter(DokumentasiKerusakanExporter::class)
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
            'index' => Pages\ListDokumentasiKerusakans::route('/'),
        ];
    }
}
