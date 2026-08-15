<?php

namespace App\Filament\Resources\Players\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Checkbox;

class PlayerForm
{

    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                // =====================================================
                // PERSONAL INFORMATION
                // =====================================================

                Section::make('ব্যক্তিগত তথ্য ও ছবি')
                    ->description('প্লেয়ারের ব্যক্তিগত তথ্য প্রদান করুন।')
                    ->icon('heroicon-o-user')
                    ->schema([

                        FileUpload::make('photo')
                            ->label('প্লেয়ারের ছবি')
                            ->helperText('সর্বোচ্চ 2MB • JPG, JPEG, PNG')
                            ->image()
                            ->imageEditor()
                            ->disk('public')
                            ->directory('players')
                            ->required()
                            ->columnSpanFull(),

                        TextInput::make('name')
                            ->label('প্লেয়ারের নাম')
                            ->placeholder('পূর্ণ নাম লিখুন')
                            ->required(),

                        TextInput::make('father_name')
                            ->label('পিতার নাম')
                            ->placeholder('পিতার নাম')
                            ->required(),

                        TextInput::make('mother_name')
                            ->label('মাতার নাম')
                            ->placeholder('মাতার নাম')
                            ->required(),

                        TextInput::make('phone')
                            ->label('মোবাইল নম্বর')
                            ->placeholder('01XXXXXXXXX')
                            ->tel()
                            ->required(),

                        DatePicker::make('date_of_birth')
                            ->label('জন্ম তারিখ')
                            ->native(false)
                            ->displayFormat('d/m/Y')
                            ->required(),

                        TextInput::make('nationality')
                            ->label('জাতীয়তা')
                            ->default('বাংলাদেশী')
                            ->required()
                            ->columnSpanFull(),
                    ])
                    ->columns(2),


                // =====================================================
                // ADDRESS
                // =====================================================

                Section::make('ঠিকানা')
                    ->description('বর্তমান ও স্থায়ী ঠিকানার তথ্য প্রদান করুন।')
                    ->icon('heroicon-o-map-pin')
                    ->schema([

                        TextInput::make('village')
                            ->label('গ্রাম')
                            ->placeholder('গ্রামের নাম')
                            ->required(),

                        TextInput::make('post_office')
                            ->label('ডাকঘর')
                            ->placeholder('ডাকঘরের নাম')
                            ->required(),

                        TextInput::make('thana')
                            ->label('থানা')
                            ->placeholder('থানার নাম')
                            ->required(),

                        TextInput::make('district')
                            ->label('জেলা')
                            ->placeholder('জেলার নাম')
                            ->required(),

                        Textarea::make('other_address')
                            ->label('অন্যান্য / বসবাসরত ঠিকানা')
                            ->placeholder('অন্যান্য ঠিকানা বিবরণ')
                            ->helperText(
                                'বসবাসরত ঠিকানা ১৮ ওয়ার্ডের মধ্যে হতে হবে। পূর্বের নিয়মিত অংশগ্রহণকারী খেলোয়াড়ের ক্ষেত্রে আলোচনা সাপেক্ষ।'
                            )
                            ->rows(3)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),


                // =====================================================
                // CRICKET PROFILE
                // =====================================================

                Section::make('ক্রিকেট প্রোফাইল')
                    ->description('প্লেয়ারের ক্রিকেট সম্পর্কিত তথ্য নির্বাচন করুন।')
                    ->icon('heroicon-o-trophy')
                    ->schema([

                        Radio::make('batting_style')
                            ->label('ব্যাটিং স্টাইল')
                            ->options([
                                'right_hand' => 'ডানহাতি (Right Hand)',
                                'left_hand' => 'বাঁহাতি (Left Hand)',
                            ])
                            ->inline()
                            ->required()
                            ->columnSpanFull(),

                        Radio::make('player_role')
                            ->label('প্লেয়ার টাইপ (মূল ভূমিকা)')
                            ->options([
                                'batsman' => 'ব্যাটার',
                                'bowler' => 'বোলার',
                                'all_rounder' => 'অলরাউন্ডার',
                                'wicket_keeper' => 'উইকেটরক্ষক',
                            ])
                            ->inline()
                            ->required()
                            ->columnSpanFull(),

                        TextInput::make('bowling_style')
                            ->label('অন্যান্য দক্ষতা / বোলিং ধরণ')
                            ->placeholder('যেমন: রাইট-আর্ম ফাস্ট / অফ স্পিন'),

                        Select::make('jersey_size')
                            ->label('জার্সি সাইজ')
                            ->options([
                                'M' => 'Medium (M)',
                                'L' => 'Large (L)',
                                'XL' => 'Extra Large (XL)',
                                'XXL' => 'Double Extra Large (XXL)',
                            ])
                            ->placeholder('সাইজ নির্বাচন করুন')
                            ->required(),

                        TextInput::make('past_team')
                            ->label('পূর্বের টিম')
                            ->placeholder('পূর্বের দলের নাম')
                            ->helperText('যদি থাকে'),

                        Textarea::make('note')
                            ->label('Note / Reference')
                            ->placeholder('কোনো বিশেষ মন্তব্য থাকলে এখানে লিখুন...')
                            ->rows(3)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),


                // =====================================================
                // TEAM / AUCTION INFORMATION
                // =====================================================

                Section::make('টিম ও নিলাম তথ্য')
                    ->description('এগুলো শুধুমাত্র Admin ব্যবস্থাপনার জন্য।')
                    ->icon('heroicon-o-building-office')
                    ->schema([

                        Select::make('category_id')
                            ->label('Player Category')
                            ->relationship('category', 'name')
                            ->searchable()
                            ->preload()
                            ->placeholder('ক্যাটাগরি নির্বাচন করুন'),

                        TextInput::make('grade')
                            ->label('Grade')
                            ->placeholder('যেমন: Grade A'),

                        TextInput::make('base_price')
                            ->label('Base Price')
                            ->numeric()
                            ->default(0)
                            ->prefix('৳'),

                        Select::make('team_id')
                            ->label('Team')
                            ->relationship('team', 'name')
                            ->searchable()
                            ->preload()
                            ->placeholder('Team নির্বাচন করুন'),

                        TextInput::make('sold_price')
                            ->label('Sold Price')
                            ->numeric()
                            ->default(0)
                            ->prefix('৳'),

                        Select::make('auction_status')
                            ->label('Auction Status')
                            ->options([
                                'available' => 'Available',
                                'bidding' => 'Bidding',
                                'sold' => 'Sold',
                                'unsold' => 'Unsold',
                            ])
                            ->default('available')
                            ->required(),

                        Select::make('status')
                            ->label('Registration Status')
                            ->options([
                                'pending' => 'Pending',
                                'approved' => 'Approved',
                                'rejected' => 'Rejected',
                            ])
                            ->default('pending')
                            ->required(),
                    ])
                    ->columns(2),



            ]);
    }
}
