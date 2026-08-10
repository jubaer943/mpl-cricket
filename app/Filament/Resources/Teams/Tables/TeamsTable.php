<?php

namespace App\Filament\Resources\Teams\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TeamsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                // লোগো সুন্দর ও গোলাকারভাবে দেখানোর জন্য ImageColumn
                ImageColumn::make('logo')
                    ->label('Team Logo')
                    ->circular() // ছবি গোলাকার করবে (প্রয়োজন না হলে কেটে দিতে পারেন)
                    ->disk('public'), // আপনার ফাইলের ডিস্কের নাম দিন (ডিফল্ট: public)

                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('owner_name')
                    ->searchable(),

                TextColumn::make('district')
                    ->searchable(),

                TextColumn::make('thana')
                    ->searchable(),

                TextColumn::make('village')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('nationality')
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
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(), // টেবিল সারিতে View বাটন
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
