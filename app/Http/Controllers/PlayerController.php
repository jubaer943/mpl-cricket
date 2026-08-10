<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Player;

class PlayerController extends Controller
{
    public function store(Request $request)
    {
        // Custom Bangla Error Messages
        $messages = [
            'photo.required' => 'প্লেয়ারের ছবি আপলোড করা আবশ্যক।',
            'photo.image' => 'আপলোড করা ফাইলটি ছবি হতে হবে।',
            'name.required' => 'প্লেয়ারের নাম লিখুন।',
            'father_name.required' => 'পিতার নাম লিখুন।',
            'mother_name.required' => 'মাতার নাম লিখুন।',
            'phone.required' => 'মোবাইল নম্বর দেওয়া আবশ্যক।',
            'date_of_birth.required' => 'জন্ম তারিখ নির্বাচন করুন।',
            'village.required' => 'গ্রামের নাম লিখুন।',
            'post_office.required' => 'ডাকঘরের নাম লিখুন।',
            'thana.required' => 'থানার নাম লিখুন।',
            'district.required' => 'জেলার নাম লিখুন।',
            'batting_style.required' => 'ব্যাটিং স্টাইল নির্বাচন করুন।',
            'player_role.required' => 'প্লেয়ার টাইপ নির্বাচন করুন।',
            'jersey_size.required' => 'জার্সি সাইজ নির্বাচন করুন।',
            'payment_method.required' => 'পেমেন্ট মেথড সিলেক্ট করুন।',
            'sender_number.required' => 'টাকা পাঠানোর নম্বরটি দিন।',
            'transaction_id.required' => 'ট্রানজেকশন আইডি (TrxID) দিন।',
            'transaction_id.unique' => 'এই ট্রানজেকশন আইডিটি ইতিমধ্যে ব্যবহৃত হয়েছে।',
            'terms.required' => 'শর্তাবলীতে টিক দিন।',
        ];

        // Validation Rules
        $validatedData = $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'name' => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'mother_name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'date_of_birth' => 'required|date',
            'nationality' => 'required|string',
            'village' => 'required|string|max:255',
            'post_office' => 'required|string|max:255',
            'thana' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'other_address' => 'nullable|string',
            'batting_style' => 'required|string',
            'player_role' => 'required|string',
            'bowling_style' => 'nullable|string',
            'jersey_size' => 'required|string',
            'past_team' => 'nullable|string',
            'grade' => 'nullable|string',
            'base_price' => 'nullable|numeric',
            'payment_method' => 'required|string',
            'sender_number' => 'required|string',
            'transaction_id' => 'required|string|unique:players,transaction_id',
            'note' => 'nullable|string',
        ], $messages);

        // Upload Photo
        if ($request->hasFile('photo')) {
            $validatedData['photo'] = $request->file('photo')->store('players', 'public');
        }

        // Save Data
        Player::create($validatedData);

        return redirect()->back()->with('success', 'আপনার প্লেয়ার নিবন্ধন সফলভাবে জমা নেওয়া হয়েছে। অ্যাডমিন প্যানেল থেকে ভেরিফাই করে অনুমোদন দেওয়া হবে।');
    }
}
