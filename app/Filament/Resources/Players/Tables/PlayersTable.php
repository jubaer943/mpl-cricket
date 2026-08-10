<?php

namespace App\Filament\Resources\Players\Tables;

use App\Models\Category;
use Filament\Forms\Components\Select;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PlayersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                // প্লেয়ারের ছবি
                ImageColumn::make('photo')
                    ->label('Photo')
                    ->circular()
                    ->disk('public'),

                // মূল তথ্য (Primary Info)
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('phone')
                    ->searchable(),

                TextColumn::make('player_role')
                    ->label('Role')
                    ->badge()
                    ->searchable(),

                TextColumn::make('category.name')
                    ->label('Category')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('grade')
                    ->sortable()
                    ->badge()
                    ->color('warning'),

                TextColumn::make('team.name')
                    ->label('Team')
                    ->placeholder('Unsold / None')
                    ->searchable(),

                TextColumn::make('base_price')
                    ->money('BDT')
                    ->sortable(),

                TextColumn::make('sold_price')
                    ->money('BDT')
                    ->sortable(),

                TextColumn::make('auction_status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'sold' => 'success',
                        'unsold' => 'danger',
                        default => 'warning',
                    }),

                TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'approved' => 'success',
                        'pending' => 'warning',
                        'rejected' => 'danger',
                        default => 'gray',
                    }),

                // যেসব তথ্য টেবিলে ডিফল্টভাবে লুকানো থাকবে (Column Toggle থেকে দেখা যাবে)
                TextColumn::make('father_name')->searchable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('mother_name')->searchable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('date_of_birth')->date()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('nationality')->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('batting_style')->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('bowling_style')->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('jersey_size')->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('past_team')->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('district')->searchable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('thana')->searchable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('village')->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('payment_method')->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('sender_number')->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('transaction_id')->searchable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                // ১. Approve Action (এখানে ক্যাটাগরি সিলেক্ট করলে ক্যাটাগরির base_price সহ আপডেট হবে)
                Action::make('approve')
                    ->label('Approve')
                    ->icon('heroicon-m-check-circle')
                    ->color('success')
                    ->visible(fn($record) => $record->status !== 'approved')
                    ->form([
                        Select::make('category_id')
                            ->label('Assign Category')
                            ->options(Category::pluck('name', 'id'))
                            ->default(fn($record) => $record->category_id)
                            ->required()
                            ->searchable(),
                    ])
                    ->action(function ($record, array $data): void {
                        $category = Category::find($data['category_id']);

                        $record->update([
                            'status' => 'approved',
                            'category_id' => $data['category_id'],
                            'base_price' => $category?->base_price ?? $record->base_price,
                        ]);
                    }),

                // ২. Reject Action
                Action::make('reject')
                    ->label('Reject')
                    ->icon('heroicon-m-x-circle')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->visible(fn($record) => $record->status !== 'rejected')
                    ->action(function ($record): void {
                        $record->update([
                            'status' => 'rejected',
                        ]);
                    }),

                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
