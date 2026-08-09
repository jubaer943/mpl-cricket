<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;

class TeamController extends Controller
{
    public function index()
    {
        return view('team-registration');
    }
    public function store(Request $request)
    {
        // ১. ভ্যালিডেশন
        $validated = $request->validate([
            'team_name'      => 'required|string|max:255',
            'team_logo'      => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'owner_name'     => 'required|string|max:255',
            'nationality'    => 'required|string|max:100',
            'village'        => 'required|string|max:255',
            'post_office'    => 'required|string|max:255',
            'police_station' => 'required|string|max:255',
            'district'       => 'required|string|max:255',
            'terms'          => 'accepted',
        ]);

        // ২. ইমেজ আপলোড
        $logoPath = null;
        if ($request->hasFile('team_logo')) {
            $logoPath = $request->file('team_logo')->store('team_logos', 'public');
        }

        // ৩. ডাটাবেজ কলামের নামের সাথে হুবহু মিলিয়ে ডাটা ইনসার্ট
        Team::create([
            'name'          => $validated['team_name'],
            'logo'          => $logoPath,
            'owner_name'    => $validated['owner_name'],
            'nationality'   => $validated['nationality'],
            'village'       => $validated['village'],
            'post_office'   => $validated['post_office'],
            'thana'         => $validated['police_station'], // ফর্মের police_station -> DB-এর thana
            'district'      => $validated['district'],
        ]);

        return redirect()->back()->with('success', 'টিম নিবন্ধন সফলভাবে সম্পন্ন হয়েছে!');
    }
}
