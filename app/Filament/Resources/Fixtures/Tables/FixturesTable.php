<?php

namespace App\Filament\Resources\Fixtures\Tables;

use App\Models\Fixture;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class FixturesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('match_number')
                    ->label('Match #')
                    ->sortable(),

                TextColumn::make('tournament.name')
                    ->label('Tournament')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('teamOne.name')
                    ->label('Team 1')
                    ->searchable(),

                TextColumn::make('teamTwo.name')
                    ->label('Team 2')
                    ->searchable(),

                TextColumn::make('team_one_score')
                    ->label('Team 1 Score')
                    ->default('-'),

                TextColumn::make('team_two_score')
                    ->label('Team 2 Score')
                    ->default('-'),

                TextColumn::make('match_type')
                    ->label('Match Type')
                    ->badge()
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'group' => 'Group Match',
                        'quarter_final' => 'Quarter Final',
                        'semi_final' => 'Semi Final',
                        'final' => 'Final',
                        default => ucfirst($state),
                    }),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'upcoming' => 'warning',
                        'live' => 'danger',
                        'completed' => 'success',
                        default => 'primary',
                    }),

                TextColumn::make('winnerTeam.name')
                    ->label('Winner')
                    ->placeholder('N/A')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label('Updated At')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),

                Action::make('scorecard')
                    ->label('Manage Scorecard')
                    ->icon('heroicon-o-document-text')
                    ->color('success')
                    ->url(fn(Fixture $record): string => route('filament.admin.pages.manage-scorecard', ['fixtureId' => $record->id])),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
