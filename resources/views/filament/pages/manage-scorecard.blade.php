<x-filament-panels::page>
    <div x-data="{ mainTab: 'scorecard', teamTab: 'team1' }" class="w-full space-y-6 font-sans">

        <!-- HEADER SCORE SUMMARY -->
        <div style="background-color: #0f172a; padding: 20px; border-radius: 12px; border: 1px solid #334155; color: #fff;"
            class="text-center">
            <h2 style="font-size: 22px; font-weight: bold; margin-bottom: 6px;">
                {{ $fixture->teamOne->name }}
                <span style="color: #38bdf8;">
                    {{ $fixture->team_one_score ? '(' . $fixture->team_one_score . ')' : '(Yet to bat)' }}
                </span>

                <span style="color: #ef4444; margin: 0 10px;">VS</span>

                {{ $fixture->teamTwo->name }}
                <span style="color: #38bdf8;">
                    {{ $fixture->team_two_score ? '(' . $fixture->team_two_score . ')' : '(Yet to bat)' }}
                </span>
            </h2>

            <!-- TOSS DISPLAY -->
            @if ($fixture->toss_winner_team_id)
                <p style="color: #eab308; font-size: 13px; margin-bottom: 4px;">
                    🪙 <strong>{{ $fixture->tossWinner->name ?? 'Toss Winner' }}</strong> টসে জিতে
                    <strong>{{ ucfirst($fixture->toss_decision ?? '') }}</strong> করার সিদ্ধান্ত নিয়েছে।
                </p>
                <p style="color: #22c55e; font-size: 14px; font-weight: bold; margin-top: 6px;">
                    ইনিংস {{ $innings_number }}: {{ $battingTeam->name ?? 'N/A' }} ব্যাটিং করছে
                    <span style="color: #cbd5e1;">| ওভার: {{ $over_number }}.{{ $valid_balls_in_over }} /
                        {{ $total_overs }}.0</span>
                </p>
            @else
                <p style="color: #ef4444; font-size: 14px; font-weight: bold; margin-top: 6px;">
                    ⚠️ ম্যাচ শুরু করতে টসের সিদ্ধান্ত নিশ্চিত করুন।
                </p>
            @endif

            @if ($fixture->target_runs)
                <p style="color: #f59e0b; font-size: 13px; font-weight: bold; margin-top: 4px;">
                    🎯 টার্গেট: {{ $fixture->target_runs }} রান
                </p>
            @endif
        </div>

        <!-- TOSS MANDATORY FORM -->
        @if (!$fixture->toss_winner_team_id)
            <div style="background-color: #1e293b; padding: 20px; border-radius: 12px; border: 2px solid #eab308; color: #fff;"
                class="space-y-4">
                <h3
                    style="font-size: 16px; font-weight: bold; color: #eab308; display: flex; align-items: center; gap: 8px;">
                    🪙 টস এবং ১ম ইনিংসের সিদ্ধান্ত
                </h3>

                <form wire:submit.prevent="saveToss"
                    style="display: grid; grid-template-columns: 1fr 1fr auto; gap: 12px; align-items: end;">
                    <div>
                        <label style="display: block; font-size: 12px; color: #94a3b8; margin-bottom: 4px;">টস বিজয়ী
                            দল</label>
                        <select wire:model="toss_winner_team_id" required
                            style="width: 100%; background: #0f172a; border: 1px solid #334155; color: #fff; border-radius: 6px; padding: 8px; font-size: 13px;">
                            <option value="">টিম সিলেক্ট করুন</option>
                            <option value="{{ $fixture->team_one_id }}">{{ $fixture->teamOne->name }}</option>
                            <option value="{{ $fixture->team_two_id }}">{{ $fixture->teamTwo->name }}</option>
                        </select>
                    </div>

                    <div>
                        <label style="display: block; font-size: 12px; color: #94a3b8; margin-bottom: 4px;">টস
                            সিদ্ধান্ত</label>
                        <select wire:model="toss_decision" required
                            style="width: 100%; background: #0f172a; border: 1px solid #334155; color: #fff; border-radius: 6px; padding: 8px; font-size: 13px;">
                            <option value="">সিদ্ধান্ত নিন</option>
                            <option value="bat">Batting (ব্যাটিং)</option>
                            <option value="bowl">Bowling (বোলিং)</option>
                        </select>
                    </div>

                    <div>
                        <button type="submit"
                            style="background: #eab308; color: #0f172a; padding: 8px 20px; border-radius: 6px; border: none; font-weight: bold; cursor: pointer; font-size: 13px;">
                            কনফার্ম টস & ম্যাচ শুরু
                        </button>
                    </div>
                </form>
            </div>
        @endif

        @php
            $battingPlayers = $battingTeam ? $battingTeam->players : collect();
            $bowlingPlayers = $bowlingTeam ? $bowlingTeam->players : collect();

            $outPlayerIds = \App\Models\BallByBall::where('fixture_id', $fixtureId)
                ->where('innings_number', $innings_number)
                ->where('is_wicket', true)
                ->pluck('dismissed_player_id')
                ->filter()
                ->toArray();

            $availableBatsmen = $battingPlayers->whereNotIn('id', $outPlayerIds);
        @endphp

        <!-- LIVE BALL INPUT PANEL -->
        @if ($fixture->status !== 'completed' && $fixture->toss_winner_team_id)
            <div style="background-color: #1e293b; padding: 20px; border-radius: 12px; border: 1px solid #334155; color: #fff;"
                class="space-y-4">

                <div style="display: grid; grid-template-columns: 2fr auto 2fr 2fr; gap: 12px; align-items: end;">
                    <!-- Striker -->
                    <div style="background: #0f172a; padding: 10px; border-radius: 8px; border: 1px solid #22c55e;">
                        <label
                            style="display: block; font-size: 11px; color: #22c55e; font-weight: bold; margin-bottom: 4px;">🏏
                            স্ট্রাইকার</label>
                        <select wire:model="batsman_id"
                            style="width: 100%; background: #1e293b; border: 1px solid #334155; color: #fff; border-radius: 6px; padding: 6px 10px; font-size: 13px;">
                            <option value="">সিলেক্ট করুন</option>
                            @foreach ($availableBatsmen as $player)
                                <option value="{{ $player->id }}">{{ $player->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Swap -->
                    <div>
                        <button wire:click="swapStrike" type="button"
                            style="background: #3b82f6; color: #fff; padding: 8px 12px; border-radius: 6px; border: none; cursor: pointer; font-size: 12px; font-weight: bold;">
                            🔄 Swap
                        </button>
                    </div>

                    <!-- Non-Striker -->
                    <div style="background: #0f172a; padding: 10px; border-radius: 8px; border: 1px solid #334155;">
                        <label
                            style="display: block; font-size: 11px; color: #94a3b8; font-weight: bold; margin-bottom: 4px;">নন-স্ট্রাইকার</label>
                        <select wire:model="non_striker_id"
                            style="width: 100%; background: #1e293b; border: 1px solid #334155; color: #fff; border-radius: 6px; padding: 6px 10px; font-size: 13px;">
                            <option value="">সিলেক্ট করুন</option>
                            @foreach ($availableBatsmen as $player)
                                <option value="{{ $player->id }}">{{ $player->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Bowler -->
                    <div style="background: #0f172a; padding: 10px; border-radius: 8px; border: 1px solid #eab308;">
                        <label
                            style="display: block; font-size: 11px; color: #eab308; font-weight: bold; margin-bottom: 4px;">⚾
                            বোলার</label>
                        <select wire:model="bowler_id"
                            style="width: 100%; background: #1e293b; border: 1px solid #334155; color: #fff; border-radius: 6px; padding: 6px 10px; font-size: 13px;">
                            <option value="">বোলার সিলেক্ট করুন</option>
                            @foreach ($bowlingPlayers as $player)
                                @if ($valid_balls_in_over == 0 && $player->id == $last_bowler_id)
                                    <option value="{{ $player->id }}" disabled>{{ $player->name }} (আগের ওভারে বোলিং
                                        করেছেন)</option>
                                @else
                                    <option value="{{ $player->id }}">{{ $player->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Ball Input & Action Buttons -->
                <div
                    style="background: #0f172a; padding: 14px; border-radius: 8px; border: 1px solid #334155; display: grid; grid-template-columns: 1fr 1fr 2fr; gap: 12px; align-items: end;">
                    <div>
                        <span style="font-size: 11px; color: #94a3b8; display: block; margin-bottom: 4px;">ব্যাটার
                            রান</span>
                        <select wire:model="batsman_runs"
                            style="width: 100%; background: #1e293b; border: 1px solid #334155; color: #fff; border-radius: 6px; padding: 6px 10px; font-size: 13px;">
                            <option value="0">0 (Dot Ball)</option>
                            <option value="1">1 Run</option>
                            <option value="2">2 Runs</option>
                            <option value="3">3 Runs</option>
                            <option value="4">4 (Boundary)</option>
                            <option value="6">6 (Six)</option>
                        </select>
                    </div>

                    <div>
                        <span style="font-size: 11px; color: #94a3b8; display: block; margin-bottom: 4px;">অতিরিক্ত
                            (Extras)</span>
                        <select wire:model="extra_type"
                            style="width: 100%; background: #1e293b; border: 1px solid #334155; color: #fff; border-radius: 6px; padding: 6px 10px; font-size: 13px;">
                            <option value="">No Extra</option>
                            <option value="wide">Wide (+1)</option>
                            <option value="no_ball">No Ball (+1)</option>
                            <option value="bye">Bye</option>
                            <option value="leg_bye">Leg Bye</option>
                        </select>
                    </div>

                    <div style="display: flex; gap: 8px;">
                        <button wire:click="submitBall" type="button"
                            style="flex: 2; background: #16a34a; color: #fff; padding: 8px 16px; border-radius: 6px; border: none; font-weight: bold; cursor: pointer;">
                            ⚽ Submit Ball
                        </button>

                        <button wire:click="openWicketModal" type="button"
                            style="flex: 1; background: #dc2626; color: #fff; padding: 8px 16px; border-radius: 6px; border: none; font-weight: bold; cursor: pointer;">
                            🚨 OUT
                        </button>
                    </div>
                </div>
            </div>
        @endif

        <!-- SCORECARD CONTAINER -->
        <div style="background-color: #1e293b; border-radius: 12px; border: 1px solid #334155; overflow: hidden;">
            <div style="display: flex; border-bottom: 1px solid #334155; background-color: #0f172a;">
                <button @click="mainTab = 'scorecard'"
                    :style="mainTab === 'scorecard' ?
                        'background-color: #1e293b; color: #38bdf8; border-bottom: 2px solid #38bdf8;' :
                        'color: #94a3b8;'"
                    style="flex: 1; padding: 12px; font-weight: bold; font-size: 14px; border: none; cursor: pointer;">
                    📋 SCORECARD
                </button>
                <button @click="mainTab = 'commentary'"
                    :style="mainTab === 'commentary' ?
                        'background-color: #1e293b; color: #38bdf8; border-bottom: 2px solid #38bdf8;' :
                        'color: #94a3b8;'"
                    style="flex: 1; padding: 12px; font-weight: bold; font-size: 14px; border: none; cursor: pointer;">
                    🎙️ BALL BY BALL
                </button>
            </div>

            <div x-show="mainTab === 'scorecard'" style="padding: 20px; color: #fff;" class="space-y-4">
                <div style="display: flex; gap: 8px; border-bottom: 1px solid #334155; padding-bottom: 10px;">
                    <button @click="teamTab = 'team1'"
                        :style="teamTab === 'team1' ? 'background: #38bdf8; color: #0f172a;' :
                            'background: #0f172a; color: #94a3b8;'"
                        style="padding: 6px 16px; border-radius: 6px; font-weight: bold; font-size: 13px; border: none; cursor: pointer;">
                        {{ $fixture->teamOne->name }}
                    </button>
                    <button @click="teamTab = 'team2'"
                        :style="teamTab === 'team2' ? 'background: #38bdf8; color: #0f172a;' :
                            'background: #0f172a; color: #94a3b8;'"
                        style="padding: 6px 16px; border-radius: 6px; font-weight: bold; font-size: 13px; border: none; cursor: pointer;">
                        {{ $fixture->teamTwo->name }}
                    </button>
                </div>

                @php
                    $teamOneStats = \App\Models\MatchPlayerStat::where('fixture_id', $fixtureId)
                        ->where('team_id', $fixture->team_one_id)
                        ->get();
                    $teamTwoStats = \App\Models\MatchPlayerStat::where('fixture_id', $fixtureId)
                        ->where('team_id', $fixture->team_two_id)
                        ->get();

                    // বোলারদের স্ট্যাটাস (balls_bowled > 0 বা রান দিলে শো করবে)
                    $teamOneBowlers = $teamTwoStats->filter(
                        fn($stat) => $stat->balls_bowled > 0 || $stat->runs_conceded > 0 || $stat->wickets_taken > 0,
                    );
                    $teamTwoBowlers = $teamOneStats->filter(
                        fn($stat) => $stat->balls_bowled > 0 || $stat->runs_conceded > 0 || $stat->wickets_taken > 0,
                    );
                @endphp

                <!-- SUB-TAB 1: TEAM ONE -->
                <div x-show="teamTab === 'team1'" class="space-y-6">
                    <div>
                        <h4 style="font-size: 13px; font-weight: bold; color: #22c55e; margin-bottom: 6px;">🏏 Batting
                        </h4>
                        @if ($teamOneStats->where('balls_faced', '>', 0)->count() > 0)
                            <table
                                style="width: 100%; border-collapse: collapse; font-size: 13px; text-align: left; background: #0f172a; border-radius: 8px; overflow: hidden;">
                                <thead>
                                    <tr style="border-bottom: 1px solid #334155; color: #94a3b8;">
                                        <th style="padding: 8px 12px;">Batter</th>
                                        <th style="padding: 8px;">Dismissal</th>
                                        <th style="padding: 8px; text-align: center;">R</th>
                                        <th style="padding: 8px; text-align: center;">B</th>
                                        <th style="padding: 8px; text-align: center;">4s</th>
                                        <th style="padding: 8px; text-align: center;">6s</th>
                                        <th style="padding: 8px; text-align: center;">S/R</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($teamOneStats->where('balls_faced', '>', 0) as $stat)
                                        <tr style="border-bottom: 1px solid #1e293b;">
                                            <td style="padding: 8px 12px; font-weight: bold;">
                                                {{ $stat->player->name ?? 'N/A' }}</td>
                                            <td style="padding: 8px; color: #94a3b8; font-size: 12px;">
                                                {{ $stat->out_type ?? 'not out' }}</td>
                                            <td style="padding: 8px; text-align: center; font-weight: bold;">
                                                {{ $stat->runs_scored }}</td>
                                            <td style="padding: 8px; text-align: center;">{{ $stat->balls_faced }}
                                            </td>
                                            <td style="padding: 8px; text-align: center;">{{ $stat->fours }}</td>
                                            <td style="padding: 8px; text-align: center;">{{ $stat->sixes }}</td>
                                            <td style="padding: 8px; text-align: center;">
                                                {{ $stat->balls_faced > 0 ? number_format(($stat->runs_scored / $stat->balls_faced) * 100, 2) : '0.00' }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p style="font-size: 12px; color: #94a3b8; font-style: italic;">Yet to bat</p>
                        @endif
                    </div>

                    <div>
                        <h4 style="font-size: 13px; font-weight: bold; color: #eab308; margin-bottom: 6px;">⚾ Bowling
                        </h4>
                        @if ($teamOneBowlers->count() > 0)
                            <table
                                style="width: 100%; border-collapse: collapse; font-size: 13px; text-align: left; background: #0f172a; border-radius: 8px; overflow: hidden;">
                                <thead>
                                    <tr style="border-bottom: 1px solid #334155; color: #94a3b8;">
                                        <th style="padding: 8px 12px;">Bowler</th>
                                        <th style="padding: 8px; text-align: center;">O</th>
                                        <th style="padding: 8px; text-align: center;">M</th>
                                        <th style="padding: 8px; text-align: center;">R</th>
                                        <th style="padding: 8px; text-align: center;">W</th>
                                        <th style="padding: 8px; text-align: center;">Econ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($teamOneBowlers as $stat)
                                        <tr style="border-bottom: 1px solid #1e293b;">
                                            <td style="padding: 8px 12px; font-weight: bold;">
                                                {{ $stat->player->name ?? 'N/A' }}</td>
                                            <td style="padding: 8px; text-align: center;">
                                                {{ number_format($stat->overs_bowled, 1) }}</td>
                                            <td style="padding: 8px; text-align: center;">
                                                {{ $stat->maiden_overs ?? 0 }}</td>
                                            <td style="padding: 8px; text-align: center;">{{ $stat->runs_conceded }}
                                            </td>
                                            <td
                                                style="padding: 8px; text-align: center; font-weight: bold; color: #ef4444;">
                                                {{ $stat->wickets_taken }}</td>
                                            <td style="padding: 8px; text-align: center;">
                                                {{ $stat->overs_bowled > 0 ? number_format($stat->runs_conceded / max($stat->overs_bowled, 0.1), 2) : '0.00' }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p style="font-size: 12px; color: #94a3b8; font-style: italic;">No bowling data available
                            </p>
                        @endif
                    </div>
                </div>

                <!-- SUB-TAB 2: TEAM TWO -->
                <div x-show="teamTab === 'team2'" class="space-y-6">
                    <div>
                        <h4 style="font-size: 13px; font-weight: bold; color: #22c55e; margin-bottom: 6px;">🏏 Batting
                        </h4>
                        @if ($teamTwoStats->where('balls_faced', '>', 0)->count() > 0)
                            <table
                                style="width: 100%; border-collapse: collapse; font-size: 13px; text-align: left; background: #0f172a; border-radius: 8px; overflow: hidden;">
                                <thead>
                                    <tr style="border-bottom: 1px solid #334155; color: #94a3b8;">
                                        <th style="padding: 8px 12px;">Batter</th>
                                        <th style="padding: 8px;">Dismissal</th>
                                        <th style="padding: 8px; text-align: center;">R</th>
                                        <th style="padding: 8px; text-align: center;">B</th>
                                        <th style="padding: 8px; text-align: center;">4s</th>
                                        <th style="padding: 8px; text-align: center;">6s</th>
                                        <th style="padding: 8px; text-align: center;">S/R</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($teamTwoStats->where('balls_faced', '>', 0) as $stat)
                                        <tr style="border-bottom: 1px solid #1e293b;">
                                            <td style="padding: 8px 12px; font-weight: bold;">
                                                {{ $stat->player->name ?? 'N/A' }}</td>
                                            <td style="padding: 8px; color: #94a3b8; font-size: 12px;">
                                                {{ $stat->out_type ?? 'not out' }}</td>
                                            <td style="padding: 8px; text-align: center; font-weight: bold;">
                                                {{ $stat->runs_scored }}</td>
                                            <td style="padding: 8px; text-align: center;">{{ $stat->balls_faced }}
                                            </td>
                                            <td style="padding: 8px; text-align: center;">{{ $stat->fours }}</td>
                                            <td style="padding: 8px; text-align: center;">{{ $stat->sixes }}</td>
                                            <td style="padding: 8px; text-align: center;">
                                                {{ $stat->balls_faced > 0 ? number_format(($stat->runs_scored / $stat->balls_faced) * 100, 2) : '0.00' }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p style="font-size: 12px; color: #94a3b8; font-style: italic;">Yet to bat</p>
                        @endif
                    </div>

                    <div>
                        <h4 style="font-size: 13px; font-weight: bold; color: #eab308; margin-bottom: 6px;">⚾ Bowling
                        </h4>
                        @if ($teamTwoBowlers->count() > 0)
                            <table
                                style="width: 100%; border-collapse: collapse; font-size: 13px; text-align: left; background: #0f172a; border-radius: 8px; overflow: hidden;">
                                <thead>
                                    <tr style="border-bottom: 1px solid #334155; color: #94a3b8;">
                                        <th style="padding: 8px 12px;">Bowler</th>
                                        <th style="padding: 8px; text-align: center;">O</th>
                                        <th style="padding: 8px; text-align: center;">M</th>
                                        <th style="padding: 8px; text-align: center;">R</th>
                                        <th style="padding: 8px; text-align: center;">W</th>
                                        <th style="padding: 8px; text-align: center;">Econ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($teamTwoBowlers as $stat)
                                        <tr style="border-bottom: 1px solid #1e293b;">
                                            <td style="padding: 8px 12px; font-weight: bold;">
                                                {{ $stat->player->name ?? 'N/A' }}</td>
                                            <td style="padding: 8px; text-align: center;">
                                                {{ number_format($stat->overs_bowled, 1) }}</td>
                                            <td style="padding: 8px; text-align: center;">
                                                {{ $stat->maiden_overs ?? 0 }}</td>
                                            <td style="padding: 8px; text-align: center;">{{ $stat->runs_conceded }}
                                            </td>
                                            <td
                                                style="padding: 8px; text-align: center; font-weight: bold; color: #ef4444;">
                                                {{ $stat->wickets_taken }}</td>
                                            <td style="padding: 8px; text-align: center;">
                                                {{ $stat->overs_bowled > 0 ? number_format($stat->runs_conceded / max($stat->overs_bowled, 0.1), 2) : '0.00' }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p style="font-size: 12px; color: #94a3b8; font-style: italic;">No bowling data available
                            </p>
                        @endif
                    </div>
                </div>

            </div>

            <!-- BALL BY BALL TIMELINE -->
            <div x-show="mainTab === 'commentary'" style="padding: 20px; color: #fff;">
                <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                    @forelse ($recentBalls as $ball)
                        <div
                            style="background: #0f172a; border: 1px solid #334155; padding: 10px 14px; border-radius: 8px; font-size: 13px;">
                            <span style="font-weight: bold; color: #38bdf8;">
                                {{ $ball->over_number }}.{{ $ball->ball_number }}
                            </span> -
                            {{ $ball->batsman->name ?? 'Batsman' }}:
                            <span style="font-weight: bold; color: {{ $ball->is_wicket ? '#ef4444' : '#22c55e' }};">
                                {{ $ball->is_wicket ? 'WICKET (' . $ball->wicket_type . ')' : $ball->batsman_runs . ($ball->extra_type ? ' [' . $ball->extra_type . ']' : '') }}
                            </span>
                        </div>
                    @empty
                        <p style="color: #94a3b8; font-size: 13px;">এখনো কোনো বল রেকর্ড করা হয়নি।</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- OUT POPUP MODAL -->
        @if ($showWicketModal)
            <div
                style="position: fixed; inset: 0; background: rgba(0,0,0,0.85); display: flex; align-items: center; justify-content: center; z-index: 50;">
                <div style="background: #1e293b; padding: 24px; border-radius: 12px; max-width: 450px; width: 100%; border: 1px solid #334155; color: #fff;"
                    class="space-y-4">
                    <h3
                        style="font-size: 18px; font-weight: bold; color: #ef4444; border-bottom: 1px solid #334155; padding-bottom: 8px;">
                        উইকেট বিবরণ ও নতুন ব্যাটার</h3>

                    <div>
                        <label style="display: block; font-size: 12px; color: #94a3b8; margin-bottom: 4px;">আউট হওয়া
                            প্লেয়ার</label>
                        <select wire:model="dismissed_player_id"
                            style="width: 100%; background: #0f172a; border: 1px solid #334155; color: #fff; border-radius: 6px; padding: 8px;">
                            <option value="{{ $batsman_id }}">Striker:
                                {{ $availableBatsmen->firstWhere('id', $batsman_id)->name ?? '' }}</option>
                            <option value="{{ $non_striker_id }}">Non-Striker:
                                {{ $availableBatsmen->firstWhere('id', $non_striker_id)->name ?? '' }}</option>
                        </select>
                    </div>

                    <div>
                        <label style="display: block; font-size: 12px; color: #94a3b8; margin-bottom: 4px;">আউটের
                            ধরন</label>
                        <select wire:model="wicket_type"
                            style="width: 100%; background: #0f172a; border: 1px solid #334155; color: #fff; border-radius: 6px; padding: 8px;">
                            <option value="bowled">Bowled</option>
                            <option value="caught">Caught</option>
                            <option value="lbw">LBW</option>
                            <option value="run_out">Run Out</option>
                            <option value="stumped">Stumped</option>
                        </select>
                    </div>

                    <div style="border-top: 1px solid #334155; padding-top: 10px;">
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

    </div>
</x-filament-panels::page>
