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
use Filament\Tables\Actions\ExportAction;
use Filament\Tables\Actions\ExportBulkAction;
use Filament\Tables\Table;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Blade;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InvoiceResource extends Resource
{
    protected static ?string $model = Invoice::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-currency-dollar';
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
                Forms\Components\Select::make('sewa_id')
                    ->relationship('sewa', 'id')
                    ->label('Sewa ID')
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set) {
                        $sewa = Sewa::with('bus')->find($state);
                        if ($sewa && $sewa->bus) {
                            $set('jumlah', $sewa->total_harga);
                        }
                    })
                    ->options(
                        // Mengambil seluruh data 'sewa' dan memformat ID-nya dengan 'RP'
                        Sewa::all()->pluck('id')->mapWithKeys(function ($id) {
                            return [
                                $id => 'RP' . $id // Format label menjadi 'RP<ID>'
                            ];
                        })
                    ),

                Forms\Components\TextInput::make('jumlah')
                    ->label('Jumlah')
                    ->numeric()
                    ->required()
                    ->rules(['min:1']),

                Forms\Components\DatePicker::make('tanggal_terbit')
                    ->label('Tanggal Terbit')
                    ->default(now())
                    ->required()
                    ->disabled(),

                Forms\Components\Select::make('status')
                    ->label('Status')
                    ->options([
                        'Belum Dibayar' => 'Belum Dibayar',
                        'Dibayar' => 'Dibayar',
                    ])
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set, callable $get) {
                        if ($state === 'Dibayar' && !$get('tanggal_terbit')) {
                            $set('tanggal_terbit', now());
                        }
                    }),
            ]);
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
                Tables\Actions\EditAction::make(),
                // Tables\Actions\Action::make('pdf')
                //     ->label('PDF')
                //     ->color('success')
                //     ->icon('heroicon-o-arrow-down-on-square')
                //     ->action(function (Invoice $record) {
                //         return response()->streamDownload(function () use ($record) {
                //             echo Pdf::loadHtml(
                //                 Blade::render('invoice', ['record' => $record])
                //             )->stream();
                //         }, $record->number . '.pdf');
                //     }),
                Tables\Actions\Action::make('download_pdf')
                    ->label('Download PDF')
                    ->icon('heroicon-o-arrow-down-on-square')
                    ->url(fn(Invoice $record) => route('invoice.download_pdf', $record)),
            ])
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
            'create' => Pages\CreateInvoice::route('/create'),
            'edit' => Pages\EditInvoice::route('/{record}/edit'),
        ];
    }
}
