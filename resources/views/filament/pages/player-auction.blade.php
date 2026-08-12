<x-filament-panels::page>
    <div style="font-family: sans-serif; max-width: 1200px; margin: 0 auto;">

        <!-- ১. ক্যাটাগরি ফিল্টার -->
        <div
            style="background-color: #1e293b; padding: 14px 20px; border-radius: 12px; border: 1px solid #334155; margin-bottom: 20px; display: flex; align-items: center; justify-content: space-between;">
            <label style="color: #f8fafc; font-weight: bold; font-size: 15px;">ক্যাটাগরি নির্বাচন করুন:</label>
            <select wire:model.live="selectedCategoryId"
                style="background-color: #0f172a; color: #fff; padding: 8px 16px; border-radius: 8px; border: 1px solid #475569; outline: none; cursor: pointer;">
                @foreach(\App\Models\Category::all() as $category)
                <option value="{{ $category->id }}">{{ $category->name }} (বেস: ৳{{ number_format($category->base_price)
                    }})</option>
                @endforeach
            </select>
        </div>

        @if($currentPlayer)
        <!-- ২. প্লেয়ার নিলাম কার্ড ও টিম সিলেকশন -->
        <div
            style="background-color: #1e293b; padding: 24px; border-radius: 16px; border: 1px solid #334155; margin-bottom: 24px;">

            <div style="display: grid; grid-template-columns: 260px 1fr 300px; gap: 24px; align-items: start;">

                <!-- ক. প্লেয়ার বায়ো -->
                <div style="text-align: center; border-right: 1px solid #334155; padding-right: 20px;">
                    <img src="{{ asset('storage/' . $currentPlayer->photo) }}"
                        style="width: 130px; height: 130px; object-fit: cover; border-radius: 12px; border: 3px solid #f59e0b; margin: 0 auto 12px auto; display: block;">

                    <h2 style="color: #fff; font-size: 20px; font-weight: 800; margin-bottom: 4px;">{{
                        $currentPlayer->name }}</h2>
                    <p style="color: #94a3b8; font-size: 12px; margin-bottom: 10px;">গ্রেড: {{ $currentPlayer->grade }}
                        | দল: {{ $currentPlayer->past_team ?? 'N/A' }}</p>

                    <div style="display: flex; justify-content: center; gap: 6px; flex-wrap: wrap;">
                        <span
                            style="background-color: #1e3a8a; color: #93c5fd; padding: 4px 10px; border-radius: 20px; font-size: 11px; font-weight: bold;">{{
                            $currentPlayer->player_role }}</span>
                        <span
                            style="background-color: #78350f; color: #fde68a; padding: 4px 10px; border-radius: 20px; font-size: 11px; font-weight: bold;">{{
                            $currentPlayer->batting_style }}</span>
                    </div>
                </div>

                <!-- খ. বিডিং কন্ট্রোল ও কারেন্ট স্ট্যাটাস -->
                <div
                    style="display: flex; flex-direction: column; justify-content: space-between; min-height: 280px; border-right: 1px solid #334155; padding-right: 20px;">
                    <div>
                        <p
                            style="color: #94a3b8; font-size: 12px; font-weight: bold; text-transform: uppercase; margin: 0;">
                            বর্তমান বিড মূল্য</p>
                        <h1 style="color: #10b981; font-size: 40px; font-weight: 900; margin: 2px 0;">৳ {{
                            number_format($currentBidPrice) }}</h1>
                        <p style="color: #cbd5e1; font-size: 12px; margin: 0;">প্রতি বিডে বাড়বে: <strong>+৳ {{
                                number_format($currentPlayer->category->bid_increment ?? 100) }}</strong></p>
                    </div>

                    <!-- কারেন্ট বিডার বা SOLD/UNSOLD বড় ব্যানার (পাবলিকের মতো) -->
                    <div>
                        @if($lastAuctionState === 'sold')
                        @php $sTeam = \App\Models\Team::find($biddingTeamId); @endphp
                        <div
                            style="background-color: #064e3b; border: 2px solid #10b981; padding: 14px; border-radius: 12px; text-align: center;">
                            <span style="color: #6ee7b7; font-size: 11px; font-weight: 900; letter-spacing: 1px;">✓ SOLD
                                TO</span>
                            <h3 style="color: #ffffff; font-size: 20px; font-weight: 900; margin: 2px 0;">{{
                                $sTeam->name ?? '' }}</h3>
                            <p style="color: #a7f3d0; font-size: 12px; margin: 0;">মূল্য: ৳{{
                                number_format($currentBidPrice) }}</p>
                        </div>
                        @elseif($lastAuctionState === 'unsold')
                        <div
                            style="background-color: #7f1d1d; border: 2px solid #ef4444; padding: 16px; border-radius: 12px; text-align: center;">
                            <h3 style="color: #fca5a5; font-size: 20px; font-weight: 900; margin: 0;">✕ UNSOLD (বিক্রি
                                হয়নি)</h3>
                        </div>
                        @else
                        <div
                            style="background-color: #0f172a; padding: 12px; border-radius: 10px; border: 1px solid #334155;">
                            <p style="color: #94a3b8; font-size: 11px; margin-bottom: 4px;">সর্বশেষ বিড করেছেন:</p>
                            @if($biddingTeamId)
                            @php $bTeam = \App\Models\Team::find($biddingTeamId); @endphp
                            <div style="display: flex; align-items: center; gap: 8px;">
                                @if($bTeam->logo)
                                <img src="{{ asset('storage/' . $bTeam->logo) }}"
                                    style="width: 28px; height: 28px; border-radius: 50%; object-fit: cover;">
                                @endif
                                <h4 style="color: #38bdf8; font-size: 16px; font-weight: bold; margin: 0;">{{
                                    $bTeam->name }}</h4>
                            </div>
                            @else
                            <p style="color: #f59e0b; font-size: 13px; font-weight: bold; margin: 0;">ডানপাশ থেকে টিমে
                                ক্লিক করে বিড শুরু করুন</p>
                            @endif
                        </div>
                        @endif
                    </div>

                    <!-- Action Buttons -->
                    <div>
                        @if(!$lastAuctionState)
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
                            <button wire:click="sellPlayer" type="button"
                                style="background-color: #2563eb; color: #ffffff; font-weight: bold; font-size: 14px; padding: 12px; border-radius: 8px; border: none; cursor: pointer;">
                                ✓ SOLD
                            </button>

                            <button wire:click="markUnsold" type="button"
                                style="background-color: #dc2626; color: #ffffff; font-weight: bold; font-size: 14px; padding: 12px; border-radius: 8px; border: none; cursor: pointer;">
                                ✕ UNSOLD
                            </button>
                        </div>
                        @else
                        <button wire:click="loadNextPlayer" type="button"
                            style="width: 100%; background-color: #059669; color: #ffffff; font-weight: bold; font-size: 15px; padding: 12px; border-radius: 8px; border: none; cursor: pointer;">
                            পরবর্তী প্লেয়ারে যান →
                        </button>
                        @endif
                    </div>
                </div>

                <!-- গ. টিম সিলেক্টর (ডানপাশে সুন্দর সারিবদ্ধ তালিকা) -->
                <div>
                    <h4 style="color: #f8fafc; font-size: 13px; font-weight: bold; margin-bottom: 10px;">অংশগ্রহণকারী
                        দলসমূহ:</h4>

                    <div
                        style="display: flex; flex-direction: column; gap: 8px; max-height: 280px; overflow-y: auto; padding-right: 4px;">
                        @foreach(\App\Models\Team::withCount('players')->get() as $team)
                        <div wire:click="placeBid({{ $team->id }})"
                            style="background-color: {{ $biddingTeamId == $team->id ? '#1e3a8a' : '#0f172a' }}; 
                                            border: 2px solid {{ $biddingTeamId == $team->id ? '#3b82f6' : '#334155' }}; 
                                            padding: 8px 12px; border-radius: 8px; display: flex; align-items: center; justify-content: space-between; cursor: pointer;">

                            <div style="display: flex; align-items: center; gap: 8px;">
                                @if($team->logo)
                                <img src="{{ asset('storage/' . $team->logo) }}"
                                    style="width: 28px; height: 28px; border-radius: 50%; object-fit: cover;">
                                @else
                                <div
                                    style="width: 28px; height: 28px; background-color: #334155; color: #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 11px; font-weight: bold;">
                                    {{ substr($team->name, 0, 2) }}
                                </div>
                                @endif
                                <span style="color: #fff; font-size: 12px; font-weight: bold;">{{ $team->name }}</span>
                            </div>

                            <span style="color: #94a3b8; font-size: 11px;">{{ $team->players_count }}/১৫</span>
                        </div>
                        @endforeach
                    </div>
                </div>

            </div>

        </div>
        @else
        <div
            style="background-color: #78350f; color: #fef3c7; padding: 24px; border-radius: 12px; text-align: center; font-weight: bold;">
            এই ক্যাটাগরিতে নিলামের জন্য কোনো প্লেয়ার নেই!
        </div>
        @endif

    </div>
</x-filament-panels::page>