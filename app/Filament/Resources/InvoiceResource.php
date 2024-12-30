<?php

namespace App\Filament\Resources;

use App\Filament\Exports\InvoiceExporter;
use App\Filament\Resources\InvoiceResource\Pages;
use App\Filament\Resources\InvoiceResource\RelationManagers;
use App\Models\Invoice;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use App\Models\Sewa;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ExportAction;
use Filament\Tables\Actions\ExportBulkAction;
use Filament\Tables\Enums\ActionsPosition;
use Filament\Tables\Table;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Tables\Actions\Action;
use Illuminate\Support\Facades\Blade;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InvoiceResource extends Resource
{
    protected static ?string $model = Invoice::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-currency-dollar';
    protected static ?string $activeNavigationIcon = 'heroicon-s-document-currency-dollar';
    protected static ?string $navigationGroup = 'Sewa';
    protected static ?string $navigationLabel = 'Invoice';
    public static function getGloballySearchableAttributes(): array
    {
        return ['jumlah', 'status'];
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Split::make([
                    Section::make([
                        Select::make('sewa_id')
                            ->relationship('sewa', 'id')
                            ->label('Sewa ID')
                            ->required()
                            ->reactive()
                            ->native(false)
                            ->afterStateUpdated(function ($state, callable $set) {
                                $sewa = Sewa::with('bus')->find($state);
                                if ($sewa && $sewa->bus) {
                                    $set('jumlah', $sewa->total_harga);
                                }
                            })
                            ->options(
                                Sewa::all()->pluck('id')->mapWithKeys(function ($id) {
                                    return [
                                        $id => 'RP' . $id
                                    ];
                                })
                            ),
                        DatePicker::make('tanggal_terbit')
                            ->label('Tanggal Terbit')
                            ->default(now())
                            ->required()
                            ->disabled(),
                    ])
                        ->columnSpan(2),
                    Section::make([
                        TextInput::make('jumlah')
                            ->label('Jumlah')
                            ->numeric()
                            ->required()
                            ->rules(['min:1']),
                        ToggleButtons::make('status')
                            ->label('Status')
                            ->options([
                                'Belum Dibayar' => 'Belum Dibayar',
                                'Dibayar' => 'Dibayar',
                            ])
                            ->colors([
                                'Belum Dibayar' => 'danger',
                                'Dibayar' => 'success',
                            ])
                            ->required()
                            ->reactive()
                            ->inline()
                            ->grouped()
                            ->afterStateUpdated(function ($state, callable $set, callable $get) {
                                if ($state === 'Dibayar' && !$get('tanggal_terbit')) {
                                    $set('tanggal_terbit', now());
                                }
                            }),
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
                Tables\Columns\TextColumn::make('sewa.id')->label('Sewa ID')->formatStateUsing(function ($record) {
                    return 'RP' . $record->sewa->id;
                }),
                Tables\Columns\TextColumn::make('jumlah')->label('Jumlah')->money('IDR', true),
                Tables\Columns\TextColumn::make('tanggal_terbit')->label('Tanggal Terbit')->date(),
                Tables\Columns\TextColumn::make('status')->label('Status'),

            ])
            ->filters([
                //
                Tables\Filters\SelectFilter::make('status')->options([
                    'Belum Dibayar' => 'Belum Dibayar',
                    'Dibayar' => 'Dibayar',
                ]),
            ])
            ->actions([
                ActionGroup::make([
                    EditAction::make(),
                    Action::make('download_pdf')
                        ->label('Download PDF')
                        ->icon('heroicon-o-arrow-down-on-square')
                        ->url(fn(Invoice $record) => route('invoice.download_pdf', $record)),
                ])
                    ->tooltip('Actions'),
            ], position: ActionsPosition::BeforeCells)
            ->headerActions([
                ExportAction::make()->exporter(InvoiceExporter::class)
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
                ExportBulkAction::make()->exporter(InvoiceExporter::class)
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
            'index' => Pages\ListInvoices::route('/'),
        ];
    }
}
