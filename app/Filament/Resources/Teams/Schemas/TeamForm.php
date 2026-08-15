<?php

namespace App\Filament\Resources\Teams\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class TeamForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                // =====================================================
                // ১. টিমের মৌলিক তথ্য
                // =====================================================
                Section::make('টিমের মৌলিক তথ্য')
                    ->description('টিমের নাম, লোগো এবং মালিকের তথ্য')
                    ->icon('heroicon-m-user-group')
                    ->schema([

                        FileUpload::make('logo')
                            ->label('টিম লোগো')
                            ->image()
                            ->disk('public')
                            ->directory('teams')
                            ->imageEditor()
                            ->imagePreviewHeight('150')
                            ->required()
                            ->columnSpanFull(),

                        TextInput::make('name')
                            ->label('দলের নাম')
                            ->placeholder('যেমন: মজমপুর টাইগার্স')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),

                        TextInput::make('owner_name')
                            ->label('মালিকের নাম')
                            ->placeholder('মালিকের পূর্ণ নাম')
                            ->required()
                            ->maxLength(255)
                            ->maxLength(100),

                        TextInput::make('age')
                            ->label('বয়স')
                            ->numeric()
                            ->minValue(1)
                            ->maxValue(120)
                            ->placeholder('বয়স লিখুন')
                            ->maxLength(20),

                        TextInput::make('nationality')
                            ->label('জাতীয়তা')
                            ->default('বাংলাদেশী')
                            ->required()
                            ->maxLength(100),

                        TextInput::make('contact_number')
                            ->label('যোগাযোগের নম্বর')
                            ->tel()
                            ->placeholder('01XXXXXXXXX')
                            ->maxLength(20),
                    ])
                    ->columnSpanFull(),
                // =====================================================
                // ৩. ঠিকানা
                // =====================================================
                Section::make('ঠিকানা')
                    ->description('টিম মালিকের বর্তমান ঠিকানা')
                    ->icon('heroicon-m-map-pin')
                    ->schema([

                        Grid::make(2)
                            ->schema([

                                TextInput::make('village')
                                    ->label('গ্রাম')
                                    ->placeholder('গ্রামের নাম')
                                    ->required()
                                    ->maxLength(255),

                                TextInput::make('district')
                                    ->label('জেলা')
                                    ->placeholder('জেলার নাম')
                                    ->required()
                                    ->maxLength(255),

                                TextInput::make('thana')
                                    ->label('থানা')
                                    ->placeholder('থানার নাম')
                                    ->required()
                                    ->maxLength(255),

                                TextInput::make('post_office')
                                    ->label('ডাকঘর')
                                    ->placeholder('ডাকঘরের নাম')
                                    ->maxLength(255),
                            ]),
                    ])
                    ->columnSpanFull(),

            ]);
    }
}
