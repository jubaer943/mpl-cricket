<?php

namespace App\Filament\Resources\Teams\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class TeamForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('logo')
                    ->default(null),
                TextInput::make('owner_name')
                    ->default(null),
                TextInput::make('contact_number')
                    ->default(null),
                TextInput::make('father_name')
                    ->default(null),
                TextInput::make('mother_name')
                    ->default(null),
                TextInput::make('district')
                    ->default(null),
                TextInput::make('thana')
                    ->default(null),
                TextInput::make('age')
                    ->default(null),
                TextInput::make('village')
                    ->default(null),
                TextInput::make('nationality')
                    ->default(null),
            ]);
    }
}
