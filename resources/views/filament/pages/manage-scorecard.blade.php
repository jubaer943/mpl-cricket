<x-filament-panels::page>
    <div style="font-family: sans-serif; max-width: 1200px; margin: 0 auto;" class="space-y-6">

        <!-- Header Scorecard Summary -->
        <div
            style="background-color: #0f172a; padding: 20px; border-radius: 12px; border: 1px solid #334155; color: #fff; text-align: center;">
            <h2 style="font-size: 22px; font-weight: bold;">
                {{ $fixture->teamOne->name }} ({{ $fixture->team_one_score ?? '0/0' }})
                <span style="color: #38bdf8; margin: 0 10px;">VS</span>
                {{ $fixture->teamTwo->name }} ({{ $fixture->team_two_score ?? '0/0' }})
            </h2>
            <p style="color: #94a3b8; font-size: 13px; margin-top: 4px;">
                ইনিংস: {{ $innings_number }} | চলতি ওভার: {{ $over_number }}.{{ $ball_number - 1 }}
            </p>
        </div>

        @php
        $battingTeam = ($innings_number == 1) ? $fixture->teamOne : $fixture->teamTwo;
        $bowlingTeam = ($innings_number == 1) ? $fixture->teamTwo : $fixture->teamOne;

        // আউট হওয়া প্লেয়ার তালিকা
        $outPlayerIds = \App\Models\BallByBall::where('fixture_id', $fixtureId)
        ->where('innings_number', $innings_number)
        ->where('is_wicket', true)
        ->pluck('dismissed_player_id')
        ->filter()
        ->toArray();

        // শুধুমাত্র অবশিষ্ট প্লেয়ার
        $availableBatsmen = $battingTeam->players->whereNotIn('id', $outPlayerIds);
        @endphp

        <!-- Main Scoring Panel -->
        <div style="background-color: #1e293b; padding: 24px; border-radius: 12px; border: 1px solid #334155; color: #fff;"
            class="space-y-6">

            <!-- Player Selection Matrix -->
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 16px;">

                <!-- Striker -->
                <div style="background: #0f172a; padding: 12px; border-radius: 8px; border: 1px solid #22c55e;">
                    <label
                        style="display: block; font-size: 12px; color: #22c55e; font-weight: bold; margin-bottom: 4px;">🏏
                        স্ট্রাইকার (Striker)</label>
                    <select wire:model="batsman_id"
                        style="width: 100%; background: #1e293b; border: 1px solid #334155; color: #fff; border-radius: 6px; padding: 8px;">
                        <option value="">সিলেক্ট করুন</option>
                        @foreach ($availableBatsmen as $player)
                        <option value="{{ $player->id }}">{{ $player->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Swap Strike Button -->
                <div style="display: flex; align-items: center; justify-content: center; margin-top: 15px;">
                    <button wire:click="swapStrike" type="button"
                        style="background: #3b82f6; color: #fff; padding: 8px 16px; border-radius: 8px; border: none; cursor: pointer; font-size: 12px; font-weight: bold;">
                        🔄 Swap Strike
                    </button>
                </div>

                <!-- Non-Striker -->
                <div style="background: #0f172a; padding: 12px; border-radius: 8px; border: 1px solid #334155;">
                    <label
                        style="display: block; font-size: 12px; color: #94a3b8; font-weight: bold; margin-bottom: 4px;">নন-স্ট্রাইকার
                        (Non-Striker)</label>
                    <select wire:model="non_striker_id"
                        style="width: 100%; background: #1e293b; border: 1px solid #334155; color: #fff; border-radius: 6px; padding: 8px;">
                        <option value="">সিলেক্ট করুন</option>
                        @foreach ($availableBatsmen as $player)
                        <option value="{{ $player->id }}">{{ $player->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Bowler -->
                <div style="background: #0f172a; padding: 12px; border-radius: 8px; border: 1px solid #eab308;">
                    <label
                        style="display: block; font-size: 12px; color: #eab308; font-weight: bold; margin-bottom: 4px;">⚾
                        বোলার (Bowler)</label>
                    <select wire:model="bowler_id"
                        style="width: 100%; background: #1e293b; border: 1px solid #334155; color: #fff; border-radius: 6px; padding: 8px;">
                        <option value="">বোলার সিলেক্ট করুন</option>
                        @foreach ($bowlingTeam->players as $player)
                        @if ($player->id != $last_bowler_id)
                        <option value="{{ $player->id }}">{{ $player->name }}</option>
                        @endif
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Fast Action Ball Entry Controls -->
            <div style="background: #0f172a; padding: 16px; border-radius: 8px; border: 1px solid #334155;">
                <label
                    style="display: block; font-size: 13px; color: #94a3b8; margin-bottom: 10px; font-weight: bold;">ইনপুট
                    রান ও বল অপশন:</label>

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 12px;">
                    <div>
                        <span style="font-size: 11px; color: #94a3b8;">ব্যাটার রান</span>
                        <select wire:model="batsman_runs"
                            style="width: 100%; background: #1e293b; border: 1px solid #334155; color: #fff; border-radius: 6px; padding: 8px;">
                            <option value="0">0 (Dot)</option>
                            <option value="1">1 Run</option>
                            <option value="2">2 Runs</option>
                            <option value="3">3 Runs</option>
                            <option value="4">4 (Four)</option>
                            <option value="6">6 (Six)</option>
                        </select>
                    </div>

                    <div>
                        <span style="font-size: 11px; color: #94a3b8;">অতিরিক্ত (Extras)</span>
                        <select wire:model="extra_type"
                            style="width: 100%; background: #1e293b; border: 1px solid #334155; color: #fff; border-radius: 6px; padding: 8px;">
                            <option value="">No Extra</option>
                            <option value="wide">Wide (+1)</option>
                            <option value="no_ball">No Ball (+1)</option>
                            <option value="bye">Bye</option>
                            <option value="leg_bye">Leg Bye</option>
                        </select>
                    </div>

                    <div style="display: flex; align-items: flex-end; gap: 8px;">
                        <button wire:click="submitBall" type="button"
                            style="flex: 1; background: #16a34a; color: #fff; padding: 10px; border-radius: 6px; border: none; font-weight: bold; cursor: pointer;">
                            ⚽ Submit Ball
                        </button>

                        <button wire:click="openWicketModal" type="button"
                            style="background: #dc2626; color: #fff; padding: 10px 16px; border-radius: 6px; border: none; font-weight: bold; cursor: pointer;">
                            🚨 OUT / Wicket
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- OUT POPUP MODAL -->
        @if ($showWicketModal)
        <div
            style="position: fixed; inset: 0; background: rgba(0,0,0,0.8); display: flex; align-items: center; justify-content: center; z-index: 50;">
            <div style="background: #1e293b; padding: 24px; border-radius: 12px; max-width: 450px; width: 100%; border: 1px solid #334155; color: #fff;"
                class="space-y-4">
                <h3
                    style="font-size: 18px; font-weight: bold; color: #ef4444; border-b: 1px solid #334155; padding-bottom: 8px;">
                    উইকেট বিবরণ ও নতুন ব্যাটার</h3>

                <div>
                    <label style="display: block; font-size: 12px; color: #94a3b8; margin-bottom: 4px;">আউট হওয়া
                        প্লেয়ার</label>
                    <select wire:model="dismissed_player_id"
                        style="width: 100%; background: #0f172a; border: 1px solid #334155; color: #fff; border-radius: 6px; padding: 8px;">
                        <option value="{{ $batsman_id }}">Striker: {{ $availableBatsmen->firstWhere('id',
                            $batsman_id)->name ?? '' }}</option>
                        <option value="{{ $non_striker_id }}">Non-Striker: {{ $availableBatsmen->firstWhere('id',
                            $non_striker_id)->name ?? '' }}</option>
                    </select>
                </div>

                <div>
                    <label style="display: block; font-size: 12px; color: #94a3b8; margin-bottom: 4px;">আউটের ধরন
                        (Wicket Type)</label>
                    <select wire:model="wicket_type"
                        style="width: 100%; background: #0f172a; border: 1px solid #334155; color: #fff; border-radius: 6px; padding: 8px;">
                        <option value="bowled">Bowled</option>
                        <option value="caught">Caught</option>
                        <option value="lbw">LBW</option>
                        <option value="run_out">Run Out</option>
                        <option value="stumped">Stumped</option>
                    </select>
                </div>

                <div>
                    <label style="display: block; font-size: 12px; color: #94a3b8; margin-bottom: 4px;">ফিল্ডার /
                        ক্যাচার (যদি থাকে)</label>
                    <select wire:model="assisted_by_player_id"
                        style="width: 100%; background: #0f172a; border: 1px solid #334155; color: #fff; border-radius: 6px; padding: 8px;">
                        <option value="">কেউ না</option>
                        @foreach ($bowlingTeam->players as $player)
                        <option value="{{ $player->id }}">{{ $player->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div style="border-t: 1px solid #334155; pt-3;">
                    <label
                        style="display: block; font-size: 12px; color: #22c55e; font-weight: bold; margin-bottom: 4px;">নতুন
                        মাঠে নামা ব্যাটার</label>
                    <select wire:model="new_batsman_id"
                        style="width: 100%; background: #0f172a; border: 1px solid #22c55e; color: #fff; border-radius: 6px; padding: 8px;">
                        <option value="">নতুন ব্যাটার সিলেক্ট করুন</option>
                        @foreach ($availableBatsmen as $player)
                        @if ($player->id != $batsman_id && $player->id != $non_striker_id)
                        <option value="{{ $player->id }}">{{ $player->name }}</option>
                        @endif
                        @endforeach
                    </select>
                </div>

                <div style="display: flex; gap: 10px; justify-content: flex-end; margin-top: 15px;">
                    <button wire:click="$set('showWicketModal', false)" type="button"
                        style="background: #64748b; color: #fff; padding: 8px 16px; border-radius: 6px; border: none; cursor: pointer;">
                        বাতিল
                    </button>
                    <button wire:click="confirmWicket" type="button"
                        style="background: #dc2626; color: #fff; padding: 8px 16px; border-radius: 6px; border: none; font-weight: bold; cursor: pointer;">
                        উইকেট কনফার্ম করুন
                    </button>
                </div>
            </div>
        </div>
        @endif

        <!-- Recent Balls Log -->
        <div
            style="background-color: #1e293b; padding: 20px; border-radius: 12px; border: 1px solid #334155; color: #fff;">
            <h3 style="font-size: 15px; font-weight: bold; margin-bottom: 12px; color: #94a3b8;">সর্বশেষ ওভারের বলসমূহ:
            </h3>
            <div style="display: flex; gap: 8px; flex-wrap: wrap;">
                @foreach ($recentBalls as $ball)
                <div
                    style="background: #0f172a; border: 1px solid #334155; padding: 8px 14px; border-radius: 8px; font-size: 13px;">
                    <span style="font-weight: bold; color: #38bdf8;">
                        {{ $ball->over_number }}.{{ $ball->ball_number }}
                    </span> -
                    {{ $ball->batsman->name ?? 'Batsman' }}:
                    <span style="font-weight: bold; color: {{ $ball->is_wicket ? '#ef4444' : '#22c55e' }};">
                        {{ $ball->is_wicket ? 'WICKET ('.$ball->wicket_type.')' : ($ball->batsman_runs .
                        ($ball->extra_type ? ' ['.$ball->extra_type.']' : '')) }}
                    </span>
                </div>
                @endforeach
            </div>
        </div>

    </div>
</x-filament-panels::page>