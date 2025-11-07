<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Product Name')
                    ->required()
                    ->maxLength(100),
                TextInput::make('description')
                    ->label('Description')
                    ->required()
                    ->maxLength(500),
                TextInput::make('price')
                    ->label('Price')
                    ->required()
                    ->numeric()
                    ->prefix('Rp'),
                TextInput::make('stock')
                    ->label('Stock')
                    ->required()
                    ->integer(),
                FileUpload::make('image')
                    ->label('Product Image')
                    ->nullable(),
            ]);
    }
}
