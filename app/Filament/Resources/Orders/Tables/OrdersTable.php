<?php

namespace App\Filament\Resources\Orders\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;

class OrdersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('order_date')->label('Tanggal Order'),
                TextColumn::make('user.name')->label('Nama Pelanggan'),
                TextColumn::make('total_amount')->label('Total')->money('idr'),
                SelectColumn::make('status')
                ->options([
                    'proses' => 'Proses',
                    'dikirim' => 'Dikirim',
                    'selesai' => 'Selesai'
                ])
                ->disablePlaceholderSelection()
                ->updateStateUsing(fn ($state, $record) => $record->update(['status' => $state]))
                
            ])
            ->filters([
                //
            ])
            ->recordActions([
                // EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    // DeleteBulkAction::make(),
                ]),
            ]);
    }
}
