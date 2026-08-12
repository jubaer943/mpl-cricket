<?php

namespace Database\Seeders;

use App\Models\Player;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class PlayerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('bn_BD');

        // ক্রিকেট সম্পর্কিত র্যান্ডম অপশন
        $battingStyles = ['Right-hand bat', 'Left-hand bat'];
        $playerRoles = ['Batsman', 'Bowler', 'All-rounder', 'Wicketkeeper Batsman'];
        $bowlingStyles = [
            'Right-arm fast',
            'Right-arm medium',
            'Right-arm offbreak',
            'Right-arm legbreak',
            'Left-arm orthodox',
            'Left-arm fast',
            null
        ];
        $jerseySizes = ['S', 'M', 'L', 'XL', 'XXL'];
        $paymentMethods = ['bKash', 'Nagad', 'Rocket'];
        $grades = ['A', 'B', 'C', 'D'];
        $basePrices = [500, 1000, 1500, 2000, 3000, 5000];
        $pastTeams = ['BDM Riders', 'Mojompur Hanters', 'Sokal Sondha Express', 'Nurbag 53', 'Joynal Sriti XI', null];

        // ৮০ জন প্লেয়ার ডেটা তৈরি
        for ($i = 1; $i <= 80; $i++) {

            $role = $faker->randomElement($playerRoles);
            // বোলার বা অলরাউন্ডার না হলে বোলিং স্টাইল খালি রাখা যেতে পারে
            $bowling = ($role === 'Batsman' && rand(0, 1) === 0)
                ? null
                : $faker->randomElement(array_filter($bowlingStyles));

            Player::create([
                'photo'            => 'players/default.jpg', // অথবা 'players/player_' . $i . '.jpg'
                'name'             => $faker->name('male'),
                'father_name'      => $faker->name('male'),
                'mother_name'      => $faker->name('female'),
                'phone'            => '01' . $faker->numberBetween(3, 9) . $faker->numerify('########'),
                'date_of_birth'    => $faker->date('Y-m-d', '2008-01-01'), // বয়স ১৮+ রাখার জন্য
                'nationality'      => 'Bangladeshi',
                'village'          => 'গ্রাম: ' . $faker->word(),
                'post_office'      => 'ডাকঘর: ' . $faker->word(),
                'thana'            => $faker->city(),
                'district'         => $faker->state(),
                'other_address'    => rand(0, 1) ? $faker->address() : null,
                'batting_style'    => $faker->randomElement($battingStyles),
                'player_role'      => $role,
                'bowling_style'    => $bowling,
                'jersey_size'      => $faker->randomElement($jerseySizes),
                'past_team'        => $faker->randomElement($pastTeams),
                'grade'            => $faker->randomElement($grades),
                'base_price'       => $faker->randomElement($basePrices),
                'payment_method'   => $faker->randomElement($paymentMethods),
                'sender_number'    => '01' . $faker->numberBetween(3, 9) . $faker->numerify('########'),
                'transaction_id'   => 'TRX' . strtoupper(Str::random(8)), // ইউনিক TrxID
                'note'             => rand(0, 1) ? 'সব তথ্য যাচাই করা হয়েছে।' : null,
            ]);
        }
    }
}
