<?php

namespace App\Filament\Resources\Players\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PlayerInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                // =====================================================
                // 1. PERSONAL INFORMATION
                // =====================================================

                Section::make('Personal Information')
                    ->description('Player basic and personal information')
                    ->icon('heroicon-m-user')
                    ->schema([

                        Grid::make(4)
                            ->schema([

                                // Player Photo
                                ImageEntry::make('photo')
                                    ->label('Player Photo')
                                    ->disk('public')
                                    ->circular()
                                    ->size(120)
                                    ->columnSpan(1),

                                // Player Information
                                Grid::make(3)
                                    ->schema([

                                        TextEntry::make('name')
                                            ->label('Player Name')
                                            ->weight('bold')
                                            ->size('lg'),

                                        TextEntry::make('phone')
                                            ->label('Phone')
                                            ->copyable()
                                            ->icon('heroicon-m-phone'),

                                        TextEntry::make('date_of_birth')
                                            ->label('Date of Birth')
                                            ->date('d M Y'),

                                        TextEntry::make('father_name')
                                            ->label("Father's Name")
                                            ->placeholder('-'),

                                        TextEntry::make('mother_name')
                                            ->label("Mother's Name")
                                            ->placeholder('-'),

                                        TextEntry::make('nationality')
                                            ->label('Nationality')
                                            ->placeholder('-'),

                                    ])
                                    ->columnSpan(3),
                            ]),
                    ]),


                // =====================================================
                // 2. ADDRESS INFORMATION
                // =====================================================

                Section::make('Address Information')
                    ->description('Player residential and contact address')
                    ->icon('heroicon-m-map-pin')
                    ->collapsible()
                    ->schema([

                        Grid::make(4)
                            ->schema([

                                TextEntry::make('village')
                                    ->label('Village')
                                    ->placeholder('-'),

                                TextEntry::make('post_office')
                                    ->label('Post Office')
                                    ->placeholder('-'),

                                TextEntry::make('thana')
                                    ->label('Thana')
                                    ->placeholder('-'),

                                TextEntry::make('district')
                                    ->label('District')
                                    ->placeholder('-'),

                                TextEntry::make('other_address')
                                    ->label('Other / Residential Address')
                                    ->placeholder('-')
                                    ->columnSpanFull(),

                            ]),
                    ]),


                // =====================================================
                // 3. CRICKET PROFILE
                // =====================================================

                Section::make('Cricket Profile')
                    ->description('Player cricketing information and playing characteristics')
                    ->icon('heroicon-m-trophy')
                    ->schema([

                        Grid::make(4)
                            ->schema([

                                TextEntry::make('player_role')
                                    ->label('Player Role')
                                    ->badge()
                                    ->formatStateUsing(
                                        fn($state) => match ($state) {
                                            'batsman' => 'Batsman',
                                            'bowler' => 'Bowler',
                                            'all_rounder' => 'All-rounder',
                                            'wicket_keeper' => 'Wicketkeeper',
                                            default => $state ?? '-',
                                        }
                                    )
                                    ->color('info'),

                                TextEntry::make('batting_style')
                                    ->label('Batting Style')
                                    ->formatStateUsing(
                                        fn($state) => match ($state) {
                                            'right_hand' => 'Right Hand',
                                            'left_hand' => 'Left Hand',
                                            default => $state ?? '-',
                                        }
                                    ),

                                TextEntry::make('bowling_style')
                                    ->label('Bowling Style')
                                    ->placeholder('-'),

                                TextEntry::make('jersey_size')
                                    ->label('Jersey Size')
                                    ->badge()
                                    ->placeholder('-'),

                                TextEntry::make('past_team')
                                    ->label('Previous Team')
                                    ->placeholder('-')
                                    ->columnSpan(2),

                                TextEntry::make('category.name')
                                    ->label('Player Category')
                                    ->placeholder('-'),

                                TextEntry::make('grade')
                                    ->label('Grade')
                                    ->badge()
                                    ->color('warning')
                                    ->placeholder('-'),

                            ]),
                    ]),


                // =====================================================
                // 4. TEAM & AUCTION INFORMATION
                // =====================================================

                Section::make('Team & Auction Information')
                    ->description('Current team, auction and financial information')
                    ->icon('heroicon-m-building-office')
                    ->schema([

                        Grid::make(4)
                            ->schema([

                                TextEntry::make('team.name')
                                    ->label('Current Team')
                                    ->badge()
                                    ->color('success')
                                    ->placeholder('Unsold / No Team'),

                                TextEntry::make('auction_status')
                                    ->label('Auction Status')
                                    ->badge()
                                    ->formatStateUsing(
                                        fn($state) => match ($state) {
                                            'available' => 'Available',
                                            'bidding' => 'Bidding',
                                            'sold' => 'Sold',
                                            'unsold' => 'Unsold',
                                            default => $state ?? '-',
                                        }
                                    )
                                    ->color(
                                        fn($state): string => match ($state) {
                                            'sold' => 'success',
                                            'unsold' => 'danger',
                                            'bidding' => 'warning',
                                            'available' => 'info',
                                            default => 'gray',
                                        }
                                    ),

                                TextEntry::make('base_price')
                                    ->label('Base Price')
                                    ->money('BDT')
                                    ->placeholder('-'),

                                TextEntry::make('sold_price')
                                    ->label('Sold Price')
                                    ->money('BDT')
                                    ->placeholder('-'),

                            ]),
                    ]),


                // =====================================================
                // 5. PAYMENT INFORMATION
                // =====================================================

                Section::make('Payment Information')
                    ->description('Registration payment details')
                    ->icon('heroicon-m-credit-card')
                    ->collapsible()
                    ->schema([

                        Grid::make(3)
                            ->schema([

                                TextEntry::make('payment_method')
                                    ->label('Payment Method')
                                    ->badge()
                                    ->formatStateUsing(
                                        fn($state) => match ($state) {
                                            'bkash' => 'bKash',
                                            'nagad' => 'Nagad',
                                            default => $state ?? '-',
                                        }
                                    ),

                                TextEntry::make('sender_number')
                                    ->label('Sender Number')
                                    ->copyable()
                                    ->placeholder('-'),

                                TextEntry::make('transaction_id')
                                    ->label('Transaction ID')
                                    ->copyable()
                                    ->fontFamily('mono')
                                    ->placeholder('-'),

                            ]),
                    ]),


                // =====================================================
                // 6. REGISTRATION STATUS
                // =====================================================

                Section::make('Registration Status')
                    ->description('Player registration and approval information')
                    ->icon('heroicon-m-check-badge')
                    ->schema([

                        Grid::make(3)
                            ->schema([

                                TextEntry::make('status')
                                    ->label('Registration Status')
                                    ->badge()
                                    ->formatStateUsing(
                                        fn($state) => match ($state) {
                                            'approved' => 'Approved',
                                            'pending' => 'Pending',
                                            'rejected' => 'Rejected',
                                            default => $state ?? '-',
                                        }
                                    )
                                    ->color(
                                        fn($state): string => match ($state) {
                                            'approved' => 'success',
                                            'pending' => 'warning',
                                            'rejected' => 'danger',
                                            default => 'gray',
                                        }
                                    ),

                                TextEntry::make('is_auction_active')
                                    ->label('Auction Active')
                                    ->badge()
                                    ->formatStateUsing(
                                        fn($state) => $state ? 'Active' : 'Inactive'
                                    )
                                    ->color(
                                        fn($state): string => $state
                                            ? 'success'
                                            : 'gray'
                                    ),

                                TextEntry::make('id')
                                    ->label('Player ID')
                                    ->copyable(),

                            ]),
                    ]),


                // =====================================================
                // 7. ADMIN NOTE
                // =====================================================

                Section::make('Admin Note')
                    ->description('Internal notes and references')
                    ->icon('heroicon-m-document-text')
                    ->collapsible()
                    ->schema([

                        TextEntry::make('note')
                            ->label('Note / Reference')
                            ->placeholder('No additional notes.')
                            ->columnSpanFull(),

                    ]),


                // =====================================================
                // 8. SYSTEM INFORMATION
                // =====================================================

                Section::make('System Information')
                    ->description('Record creation and update information')
                    ->icon('heroicon-m-cog-6-tooth')
                    ->collapsible()
                    ->schema([

                        Grid::make(2)
                            ->schema([

                                TextEntry::make('created_at')
                                    ->label('Created At')
                                    ->dateTime('d M Y, h:i A')
                                    ->placeholder('-'),

                                TextEntry::make('updated_at')
                                    ->label('Last Updated')
                                    ->dateTime('d M Y, h:i A')
                                    ->placeholder('-'),

                            ]),
                    ]),

            ]);
    }
}
