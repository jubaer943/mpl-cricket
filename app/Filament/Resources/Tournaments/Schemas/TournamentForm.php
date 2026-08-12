<?php

namespace App\Filament\Resources\Tournaments\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class TournamentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Tournament Information')
                    ->schema([
                        TextInput::make('name')
                            ->label('Tournament Name')
                            ->required()
                            ->maxLength(255),

                        Select::make('status')
                            ->label('Status')
                            ->options([
                                'upcoming' => 'Upcoming',
                                'running' => 'Running',
                                'completed' => 'Completed',
                            ])
                            ->default('upcoming')
                            ->required(),

                        TextInput::make('total_matches')
                            ->label('Total Matches')
                            ->numeric()
                            ->default(0)
                            ->required(),

                        TextInput::make('completed_matches')
                            ->label('Completed Matches')
                            ->numeric()
                            ->default(0)
                            ->required(),

                        // Select::make('champion_team_id')
                        //     ->label('Champion Team')
                        //     ->relationship('championTeam', 'name')
                        //     ->searchable()
                        //     ->nullable(),

                        // Select::make('runner_up_team_id')
                        //     ->label('Runner Up Team')
                        //     ->relationship('runnerUpTeam', 'name')
                        //     ->searchable()
                        //     ->nullable(),

                        Toggle::make('is_active')
                            ->label('Is Active')
                            ->default(true)
                            ->required(),
                    ])->columns(2),

                Section::make('Participating Teams')
                    ->schema([
                        Select::make('teams')
                            ->label('Select Teams')
                            ->multiple()
                            ->relationship('teams', 'name')
                            ->preload()
                            ->required(),
                    ]),
            ]);
    }
}
