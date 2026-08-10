<?php

namespace App\Filament\Resources\Players\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class PlayerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('photo')
                    ->required(),
                TextInput::make('name')
                    ->required(),
                TextInput::make('father_name')
                    ->required(),
                TextInput::make('mother_name')
                    ->required(),
                TextInput::make('phone')
                    ->tel()
                    ->required(),
                DatePicker::make('date_of_birth')
                    ->required(),
                TextInput::make('nationality')
                    ->required()
                    ->default('বাংলাদেশী'),
                TextInput::make('village')
                    ->required(),
                TextInput::make('post_office')
                    ->required(),
                TextInput::make('thana')
                    ->required(),
                TextInput::make('district')
                    ->required(),
                Textarea::make('other_address')
                    ->default(null)
                    ->columnSpanFull(),
                TextInput::make('batting_style')
                    ->required(),
                TextInput::make('player_role')
                    ->required(),
                TextInput::make('bowling_style')
                    ->default(null),
                TextInput::make('jersey_size')
                    ->required(),
                TextInput::make('past_team')
                    ->default(null),
                Select::make('category_id')
                    ->relationship('category', 'name')
                    ->default(null),
                TextInput::make('grade')
                    ->default(null),
                TextInput::make('base_price')
                    ->numeric()
                    ->default(0.0)
                    ->prefix('$'),
                Select::make('team_id')
                    ->relationship('team', 'name')
                    ->default(null),
                TextInput::make('sold_price')
                    ->required()
                    ->numeric()
                    ->default(0.0)
                    ->prefix('$'),
                Select::make('auction_status')
                    ->options(['available' => 'Available', 'bidding' => 'Bidding', 'sold' => 'Sold', 'unsold' => 'Unsold'])
                    ->default('available')
                    ->required(),
                TextInput::make('payment_method')
                    ->required(),
                TextInput::make('sender_number')
                    ->required(),
                TextInput::make('transaction_id')
                    ->required(),
                Select::make('status')
                    ->options(['pending' => 'Pending', 'approved' => 'Approved', 'rejected' => 'Rejected'])
                    ->default('pending')
                    ->required(),
                Textarea::make('note')
                    ->default(null)
                    ->columnSpanFull(),
            ]);
    }
}
