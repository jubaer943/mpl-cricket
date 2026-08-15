<x-layouts.master>

    <div id="page-players" class="page bg-creamdark min-h-screen py-10">

        <div class="max-w-7xl mx-auto px-4 sm:px-6">

            <!-- Back -->
            <button onclick="go('home')" class="text-sm text-pitch font-semibold hover:underline mb-4">
                ← হোমে ফিরুন
            </button>


            <!-- Page Header -->
            <div class="mb-8">

                <p class="text-maroon font-semibold tracking-widest text-xs">
                    PLAYERS
                </p>

                <h2 class="font-display font-700 text-3xl sm:text-4xl mt-1">
                    সম্পূর্ণ খেলোয়াড় তালিকা
                </h2>

            </div>


            <!-- Filters -->
            <div class="flex flex-wrap gap-3 mb-6">

                <!-- Search -->
                <input id="playerSearch" type="text" placeholder="নাম দিয়ে খুঁজুন..." oninput="renderPlayers()"
                    class="flex-1 min-w-[200px] rounded-xl border border-ink/15 px-4 py-2.5 bg-white focus:border-gold outline-none text-sm">


                <!-- Team -->
                <select id="playerTeamFilter" onchange="renderPlayers()"
                    class="rounded-xl border border-ink/15 px-4 py-2.5 bg-white focus:border-gold outline-none text-sm">

                    <option value="">
                        All Teams
                    </option>

                </select>


                <!-- Role -->
                <select id="playerRoleFilter" onchange="renderPlayers()"
                    class="rounded-xl border border-ink/15 px-4 py-2.5 bg-white focus:border-gold outline-none text-sm">

                    <option value="">
                        All Roles
                    </option>

                    <option value="Wicketkeeper Batsman">
                        Wicketkeeper Batsman
                    </option>

                    <option value="Batsman">
                        Batsman
                    </option>

                    <option value="Bowler">
                        Bowler
                    </option>

                    <option value="All-rounder">
                        All-rounder
                    </option>

                </select>

            </div>


            <!-- Count -->
            <p id="playerCountLabel" class="text-ink/50 text-sm mb-3"></p>


            <x-partials.players.performance-table />

        </div>

    </div>

    <script>
        window.playersData = @json($topPerformers);
    </script>

    <script src="{{ asset('js/players/performance-table.js') }}"></script>
</x-layouts.master>