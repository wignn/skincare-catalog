<?php

namespace App\Filament\Resources\Products\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Actions\DeleteAction;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->searchDebounce(300)
            ->columns([
                TextColumn::make('name')->label('Product Name')->searchable(),
                TextColumn::make('description')->label('Description')->limit(50),
                TextColumn::make('price')->label('Price')->money('idr', true),
                TextColumn::make('stock')->label('Stock'),
                ImageColumn::make('image')
                ->label('Product Image')
                ->getStateUsing(fn ($record) => $record->image_url)
                ->square()
                ->size(70),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
