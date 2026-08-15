@props([
'players' => collect(),
])
<div class="overflow-x-auto rounded-2xl border border-ink/10 bg-cream shadow-sm">

    <table class="min-w-full text-sm">

        <!-- Table Header -->
        <thead class="bg-pitchdark text-cream">

            <!-- Main Header -->
            <tr>

                <!-- Rank -->
                <th rowspan="2"
                    class="px-4 py-3 text-center font-display font-600 border-r border-cream/10 whitespace-nowrap">
                    Rank
                </th>


                <!-- Player -->
                <th rowspan="2"
                    class="px-4 py-3 text-left font-display font-600 border-r border-cream/10 whitespace-nowrap">
                    Player
                </th>


                <!-- Team -->
                <th rowspan="2"
                    class="px-4 py-3 text-left font-display font-600 border-r border-cream/10 whitespace-nowrap">
                    Team
                </th>


                <!-- Role -->
                <th rowspan="2"
                    class="px-4 py-3 text-left font-display font-600 border-r border-cream/10 whitespace-nowrap">
                    Role
                </th>


                <!-- Matches -->
                <th rowspan="2"
                    class="px-4 py-3 text-center font-display font-600 border-r border-cream/10 whitespace-nowrap">
                    Matches
                </th>


                <!-- Batting -->
                <th colspan="6"
                    class="px-4 py-2 text-center font-display font-700 text-sm border-b border-r border-cream/10 whitespace-nowrap">
                    🏏 Batting Performance
                </th>


                <!-- Bowling -->
                <th colspan="4"
                    class="px-4 py-2 text-center font-display font-700 text-sm border-b border-cream/10 whitespace-nowrap">
                    🎯 Bowling Performance
                </th>


            </tr>


            <!-- Sub Header -->
            <tr>

                <!-- Batting -->

                <th class="px-4 py-2 text-center font-display font-600 text-xs whitespace-nowrap">
                    Runs
                </th>

                <th class="px-4 py-2 text-center font-display font-600 text-xs whitespace-nowrap">
                    HS
                </th>

                <th class="px-4 py-2 text-center font-display font-600 text-xs whitespace-nowrap">
                    50s
                </th>

                <th class="px-4 py-2 text-center font-display font-600 text-xs whitespace-nowrap">
                    100s
                </th>

                <th class="px-4 py-2 text-center font-display font-600 text-xs whitespace-nowrap">
                    4s
                </th>

                <th
                    class="px-4 py-2 text-center font-display font-600 text-xs border-r border-cream/10 whitespace-nowrap">
                    6s
                </th>


                <!-- Bowling -->

                <th class="px-4 py-2 text-center font-display font-600 text-xs whitespace-nowrap">
                    Overs
                </th>

                <th class="px-4 py-2 text-center font-display font-600 text-xs whitespace-nowrap">
                    Runs
                </th>

                <th class="px-4 py-2 text-center font-display font-600 text-xs whitespace-nowrap">
                    Wickets
                </th>

                <th class="px-4 py-2 text-center font-display font-600 text-xs whitespace-nowrap">
                    Economy
                </th>

            </tr>

        </thead>


        <!-- Table Body -->
        <tbody id="allPlayersBody" class="divide-y divide-ink/10">
        </tbody>

    </table>

</div>