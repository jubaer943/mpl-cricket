<?php

namespace App\Filament\Resources\Fixtures\Schemas;

use App\Models\Team;
use App\Models\Tournament;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class FixtureForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Match Schedule Information')
                    ->schema([
                        Select::make('tournament_id')
                            ->label('Tournament')
                            ->options(Tournament::where('is_active', true)->pluck('name', 'id'))
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(fn(callable $set) => $set('team_one_id', null) && $set('team_two_id', null)),

                        TextInput::make('match_number')
                            ->label('Match Number')
                            ->placeholder('e.g. 1, 2')
                            ->numeric()
                            ->required(),

                        Select::make('team_one_id')
                            ->label('Team 1 (Team A)')
                            ->options(function (callable $get) {
                                $tournamentId = $get('tournament_id');
                                if (!$tournamentId) return [];
                                return Tournament::find($tournamentId)?->teams()->pluck('name', 'teams.id') ?? [];
                            })
                            ->required()
                            ->reactive(),

                        Select::make('team_two_id')
                            ->label('Team 2 (Team B)')
                            ->options(function (callable $get) {
                                $tournamentId = $get('tournament_id');
                                $teamOneId = $get('team_one_id');
                                if (!$tournamentId) return [];
                                return Tournament::find($tournamentId)?->teams()
                                    ->when($teamOneId, fn($q) => $q->where('teams.id', '!=', $teamOneId))
                                    ->pluck('name', 'teams.id') ?? [];
                            })
                            ->required(),

                        Select::make('match_type')
                            ->label('Match Type')
                            ->options([
                                'group' => 'Group Match',
                                'quarter_final' => 'Quarter Final',
                                'semi_final' => 'Semi Final',
                                'final' => 'Final',
                            ])
                            ->default('group')
                            ->required(),

                        Select::make('status')
                            ->label('Match Status')
                            ->options([
                                'upcoming' => 'Upcoming',
                                'live' => 'Live',
                                'completed' => 'Completed',
                            ])
                            ->default('upcoming')
                            ->required(),
                    ])->columns(2),

                Section::make('Match Summary & Results')
                    ->schema([
                        TextInput::make('team_one_score')
                            ->label('Team 1 Score')
                            ->placeholder('e.g. 185/6'),

                        TextInput::make('team_one_overs')
                            ->label('Team 1 Overs')
                            ->placeholder('e.g. 20.0'),

                        TextInput::make('team_two_score')
                            ->label('Team 2 Score')
                            ->placeholder('e.g. 180/9'),

                        TextInput::make('team_two_overs')
                            ->label('Team 2 Overs')
                            ->placeholder('e.g. 19.4'),

                        Select::make('winner_team_id')
                            ->label('Winner Team')
                            ->options(function (callable $get) {
                                $t1 = $get('team_one_id');
                                $t2 = $get('team_two_id');
                                if (!$t1 || !$t2) return [];
                                return Team::whereIn('id', [$t1, $t2])->pluck('name', 'id');
                            }),

                        TextInput::make('result_description')
                            ->label('Result Description')
                            ->placeholder('e.g. Team A won by 5 runs'),
                    ])->columns(2)->collapsible(),
            ]);
    }
}
