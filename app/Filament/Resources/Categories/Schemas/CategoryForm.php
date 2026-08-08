<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('base_price')
                    ->required()
                    ->numeric()
                    ->default(0.0)
                    ->prefix('৳'),
                TextInput::make('bid_increment')
                    ->required()
                    ->numeric()
                    ->default(100.0),
            ]);
    }
}
