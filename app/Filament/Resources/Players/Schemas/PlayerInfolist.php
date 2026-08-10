<?php

namespace App\Filament\Resources\Players\Schemas;

use Filament\Schemas\Components\Grid;
use Filament\Infolists\Components\ImageEntry;
use Filament\Schemas\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class PlayerInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // ১. ব্যক্তিগত তথ্য (Personal Information)
                Section::make('Personal Information')
                    ->icon('heroicon-m-user')
                    ->schema([
                        Grid::make(4)->schema([
                            ImageEntry::make('photo')
                                ->label('Player Photo')
                                ->circular()
                                ->disk('public')
                                ->columnSpan(1),

                            Grid::make(3)->schema([
                                TextEntry::make('name')
                                    ->weight('bold'),
                                TextEntry::make('phone')
                                    ->copyable(),
                                TextEntry::make('date_of_birth')
                                    ->date(),
                                TextEntry::make('father_name')
                                    ->placeholder('-'),
                                TextEntry::make('mother_name')
                                    ->placeholder('-'),
                                TextEntry::make('nationality')
                                    ->placeholder('-'),
                            ])->columnSpan(3),
                        ]),
                    ]),

                // ২. ঠিকানা (Address Details)
                Section::make('Address Details')
                    ->icon('heroicon-m-map-pin')
                    ->collapsible()
                    ->schema([
                        Grid::make(4)->schema([
                            TextEntry::make('village')->placeholder('-'),
                            TextEntry::make('post_office')->placeholder('-'),
                            TextEntry::make('thana')->placeholder('-'),
                            TextEntry::make('district')->placeholder('-'),
                            TextEntry::make('other_address')
                                ->placeholder('-')
                                ->columnSpanFull(),
                        ]),
                    ]),

                // ৩. ক্রিকেট ও নিলামের তথ্য (Cricket & Auction Info)
                Section::make('Cricket & Auction Details')
                    ->icon('heroicon-m-trophy')
                    ->schema([
                        Grid::make(4)->schema([
                            TextEntry::make('player_role')
                                ->badge()
                                ->color('info'),
                            TextEntry::make('batting_style')
                                ->placeholder('-'),
                            TextEntry::make('bowling_style')
                                ->placeholder('-'),
                            TextEntry::make('jersey_size')
                                ->placeholder('-'),

                            TextEntry::make('category.name')
                                ->label('Category')
                                ->placeholder('-'),
                            TextEntry::make('grade')
                                ->badge()
                                ->color('warning')
                                ->placeholder('-'),
                            TextEntry::make('past_team')
                                ->placeholder('-'),
                            TextEntry::make('team.name')
                                ->label('Current Team')
                                ->placeholder('Unsold / None'),

                            TextEntry::make('base_price')
                                ->money('BDT')
                                ->placeholder('-'),
                            TextEntry::make('sold_price')
                                ->money('BDT')
                                ->placeholder('-'),
                            TextEntry::make('auction_status')
                                ->badge()
                                ->color(fn($state): string => match ($state) {
                                    'sold' => 'success',
                                    'unsold' => 'danger',
                                    default => 'warning',
                                }),
                            TextEntry::make('status')
                                ->badge()
                                ->color(fn($state): string => match ($state) {
                                    'approved' => 'success',
                                    'pending' => 'warning',
                                    'rejected' => 'danger',
                                    default => 'gray',
                                }),
                        ]),
                    ]),

                // ৪. পেমেন্ট ও সিস্টেম নোটিশ (Payment & System Info)
                Section::make('Payment & Admin Info')
                    ->icon('heroicon-m-credit-card')
                    ->collapsible()
                    ->schema([
                        Grid::make(3)->schema([
                            TextEntry::make('payment_method')->placeholder('-'),
                            TextEntry::make('sender_number')->placeholder('-'),
                            TextEntry::make('transaction_id')
                                ->copyable()
                                ->placeholder('-'),
                            TextEntry::make('note')
                                ->placeholder('No additional notes.')
                                ->columnSpanFull(),
                            TextEntry::make('created_at')
                                ->dateTime()
                                ->placeholder('-'),
                            TextEntry::make('updated_at')
                                ->dateTime()
                                ->placeholder('-'),
                        ]),
                    ]),
            ]);
    }
}
