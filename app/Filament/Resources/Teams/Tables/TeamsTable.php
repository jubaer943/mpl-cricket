<?php

namespace App\Filament\Resources\Teams\Tables;

use App\Models\Player;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\DB;

class TeamsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(
                fn($query) => $query->withCount('players')
            )
            /*
            |--------------------------------------------------------------------------
            | Columns
            |--------------------------------------------------------------------------
            */

            ->columns([

                ImageColumn::make('logo')
                    ->label('Team Logo')
                    ->circular()
                    ->disk('public'),

                TextColumn::make('name')
                    ->label('Team')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('players_count')
                    ->label('Players')
                    ->badge()
                    ->sortable(),

                TextColumn::make('owner_name')
                    ->label('Owner')
                    ->searchable(),

                TextColumn::make('district')
                    ->label('District')
                    ->searchable(),

                TextColumn::make('thana')
                    ->label('Thana')
                    ->searchable(),

                TextColumn::make('village')
                    ->label('Village')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('nationality')
                    ->label('Nationality')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])

            /*
            |--------------------------------------------------------------------------
            | Filters
            |--------------------------------------------------------------------------
            */

            ->filters([])

            /*
            |--------------------------------------------------------------------------
            | Record Actions
            |--------------------------------------------------------------------------
            */

            ->recordActions([

                ViewAction::make(),

                EditAction::make(),

                /*
                |--------------------------------------------------------------------------
                | Players / Playing XI
                |--------------------------------------------------------------------------
                */

                Action::make('players')

                    ->label('Players')

                    ->icon('heroicon-m-users')

                    ->color('info')

                    ->modalHeading(
                        fn($record) =>
                        $record->name . ' — Playing XI'
                    )

                    ->modalDescription(
                        'Select the players who will play in the XI and choose a captain.'
                    )

                    ->modalWidth('2xl')

                    /*
                    |--------------------------------------------------------------------------
                    | Form
                    |--------------------------------------------------------------------------
                    */

                    ->form(function ($record) {

                        $players = Player::query()
                            ->where('team_id', $record->id)
                            ->orderBy('name')
                            ->get();

                        $components = [];

                        /*
                        |--------------------------------------------------------------------------
                        | Team Player Count
                        |--------------------------------------------------------------------------
                        */

                        $components[] = Placeholder::make('player_count')
                            ->label('Team Players')
                            ->content(
                                $players->count() . ' players'
                            );

                        /*
                        |--------------------------------------------------------------------------
                        | Playing XI Section
                        |--------------------------------------------------------------------------
                        */

                        foreach ($players as $player) {

                            $components[] = Checkbox::make(
                                "playing_xi.{$player->id}"
                            )

                                ->label(
                                    $player->name .
                                        ' — ' .
                                        ($player->player_role ?? 'Player')
                                )

                                ->default(
                                    (bool) $player->is_playing_xi
                                )

                                ->live()

                                /*
                                |--------------------------------------------------------------------------
                                | If Captain is unchecked from Playing XI
                                | automatically remove Captain selection
                                |--------------------------------------------------------------------------
                                */

                                ->afterStateUpdated(
                                    function (
                                        $state,
                                        Get $get,
                                        Set $set
                                    ) use ($player) {

                                        /*
                                        |--------------------------------------------------------------------------
                                        | Player unchecked
                                        |--------------------------------------------------------------------------
                                        */

                                        if (! $state) {

                                            $captainId = $get(
                                                'captain_id'
                                            );

                                            /*
                                            |--------------------------------------------------------------------------
                                            | If this player was captain
                                            |--------------------------------------------------------------------------
                                            */

                                            if (
                                                (string) $captainId ===
                                                (string) $player->id
                                            ) {

                                                $set(
                                                    'captain_id',
                                                    null
                                                );
                                            }
                                        }
                                    }
                                );
                        }

                        /*
                        |--------------------------------------------------------------------------
                        | Captain Dropdown
                        |--------------------------------------------------------------------------
                        */

                        $components[] = Select::make('captain_id')

                            ->label('Select Captain')

                            ->placeholder(
                                'Select a captain from Playing XI'
                            )

                            ->options(
                                function (Get $get) use ($players) {

                                    $playingXi = collect(
                                        $get('playing_xi') ?? []
                                    )
                                        ->filter(
                                            fn($selected) =>
                                            (bool) $selected
                                        )
                                        ->keys()
                                        ->map(
                                            fn($id) => (int) $id
                                        );

                                    return $players
                                        ->whereIn(
                                            'id',
                                            $playingXi
                                        )
                                        ->pluck(
                                            'name',
                                            'id'
                                        )
                                        ->toArray();
                                }
                            )

                            ->searchable()

                            ->live()

                            /*
                            |--------------------------------------------------------------------------
                            | Existing Captain
                            |--------------------------------------------------------------------------
                            */

                            ->default(
                                $players
                                    ->firstWhere(
                                        'is_captain',
                                        true
                                    )
                                    ?->id
                            )

                            /*
                            |--------------------------------------------------------------------------
                            | Captain অবশ্যই Playing XI-এর মধ্যে থাকতে হবে
                            |--------------------------------------------------------------------------
                            */

                            ->rule(
                                function (Get $get) {

                                    return function (
                                        string $attribute,
                                        $value,
                                        \Closure $fail
                                    ) use ($get) {

                                        if (! $value) {
                                            return;
                                        }

                                        $playingXi = collect(
                                            $get('playing_xi') ?? []
                                        )
                                            ->filter(
                                                fn($selected) =>
                                                (bool) $selected
                                            )
                                            ->keys()
                                            ->map(
                                                fn($id) => (int) $id
                                            );

                                        if (
                                            ! $playingXi->contains(
                                                (int) $value
                                            )
                                        ) {

                                            $fail(
                                                'Captain must be selected from the Playing XI.'
                                            );
                                        }
                                    };
                                }
                            )

                            ->helperText(
                                'Captain must be one of the selected Playing XI players.'
                            );

                        return $components;
                    })

                    /*
                    |--------------------------------------------------------------------------
                    | Save
                    |--------------------------------------------------------------------------
                    */

                    ->action(function (
                        array $data,
                        $record
                    ) {

                        DB::transaction(function () use (
                            $data,
                            $record
                        ) {

                            /*
                            |--------------------------------------------------------------------------
                            | Selected Playing XI
                            |--------------------------------------------------------------------------
                            */

                            $playingXiIds = collect(
                                $data['playing_xi'] ?? []
                            )
                                ->filter(
                                    fn($selected) =>
                                    (bool) $selected
                                )
                                ->keys()
                                ->map(
                                    fn($id) => (int) $id
                                )
                                ->values();

                            /*
                            |--------------------------------------------------------------------------
                            | Selected Captain
                            |--------------------------------------------------------------------------
                            */

                            $captainId = ! empty($data['captain_id'])
                                ? (int) $data['captain_id']
                                : null;

                            /*
                            |--------------------------------------------------------------------------
                            | Safety:
                            | Captain must be in Playing XI
                            |--------------------------------------------------------------------------
                            */

                            if (
                                $captainId &&
                                ! $playingXiIds->contains(
                                    $captainId
                                )
                            ) {

                                $captainId = null;
                            }

                            /*
                            |--------------------------------------------------------------------------
                            | First reset ALL players of this team
                            |--------------------------------------------------------------------------
                            */

                            Player::query()
                                ->where(
                                    'team_id',
                                    $record->id
                                )
                                ->update([
                                    'is_playing_xi' => false,
                                    'is_captain' => false,
                                ]);

                            /*
                            |--------------------------------------------------------------------------
                            | Set Playing XI
                            |--------------------------------------------------------------------------
                            */

                            if ($playingXiIds->isNotEmpty()) {

                                Player::query()
                                    ->where(
                                        'team_id',
                                        $record->id
                                    )
                                    ->whereIn(
                                        'id',
                                        $playingXiIds
                                    )
                                    ->update([
                                        'is_playing_xi' => true,
                                    ]);
                            }

                            /*
                            |--------------------------------------------------------------------------
                            | Set Captain
                            |--------------------------------------------------------------------------
                            */

                            if ($captainId) {

                                Player::query()
                                    ->where(
                                        'team_id',
                                        $record->id
                                    )
                                    ->where(
                                        'id',
                                        $captainId
                                    )
                                    ->update([
                                        'is_playing_xi' => true,
                                        'is_captain' => true,
                                    ]);
                            }
                        });
                    })

                    /*
                    |--------------------------------------------------------------------------
                    | Success Notification
                    |--------------------------------------------------------------------------
                    */

                    ->successNotificationTitle(
                        'Playing XI updated successfully'
                    ),
            ])

            /*
            |--------------------------------------------------------------------------
            | Bulk Actions
            |--------------------------------------------------------------------------
            */

            ->toolbarActions([

                BulkActionGroup::make([

                    DeleteBulkAction::make(),

                ]),

            ]);
    }
}
