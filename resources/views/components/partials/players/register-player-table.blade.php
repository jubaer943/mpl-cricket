<div class="p-3" style="margin: 20px">
    <div class="overflow-x-auto rounded-2xl border border-ink/10 bg-cream shadow-sm">
        <table class="min-w-full table-fixed text-sm">
            <!-- Table Header -->
            <thead class="bg-pitchdark text-cream">
                <tr>
                    <th
                        class="w-16 px-4 py-3 text-center font-display font-600 border-r border-cream/10 whitespace-nowrap">
                        Rank</th>
                    <th
                        class="w-20 px-4 py-3 text-center font-display font-600 border-r border-cream/10 whitespace-nowrap">
                        Photo</th>
                    <th class="px-4 py-3 text-left font-display font-600 border-r border-cream/10 whitespace-nowrap">
                        Player
                        Name</th>
                    <th
                        class="w-36 px-4 py-3 text-left font-display font-600 border-r border-cream/10 whitespace-nowrap">
                        Category</th>
                    <th
                        class="w-40 px-4 py-3 text-left font-display font-600 border-r border-cream/10 whitespace-nowrap">
                        Role</th>
                    <th class="w-36 px-4 py-3 text-center font-display font-600 whitespace-nowrap">Auction Status</th>
                </tr>
            </thead>

            <!-- Table Body -->
            <tbody class="divide-y divide-ink/10">
                @foreach ($players as $index => $player)
                    <tr class="hover:bg-ink/5 transition-colors">
                        <!-- Rank -->
                        <td class="px-4 py-3 text-center font-600 border-r border-ink/10 whitespace-nowrap text-ink">
                            {{ $index + 1 }}
                        </td>

                        <!-- Photo -->
                        <td class="px-4 py-3 text-center border-r border-ink/10 whitespace-nowrap">
                            <img src="{{ asset('storage/' . $player->photo) }}" alt="{{ $player->name }}"
                                class="w-9 h-9 mx-auto rounded-full object-cover border border-ink/20">
                        </td>

                        <!-- Player Name -->
                        <td class="px-4 py-3 text-left font-600 text-ink border-r border-ink/10 truncate">
                            {{ $player->name }}
                        </td>

                        <!-- Category -->
                        <td class="px-4 py-3 text-left text-ink/80 border-r border-ink/10 truncate">
                            {{ $player->category->name ?? ($player->grade ?? 'N/A') }}
                        </td>

                        <!-- Role -->
                        <td class="px-4 py-3 text-left text-ink/80 border-r border-ink/10 truncate">
                            {{ $player->player_role }}
                        </td>

                        <!-- Auction Status Badge -->
                        <td class="px-4 py-3 text-center whitespace-nowrap">
                            @if ($player->auction_status === 'sold')
                                <span
                                    class="inline-block px-3 py-1 text-xs font-medium bg-emerald-600 text-white rounded-full shadow-sm">Sold</span>
                            @elseif($player->auction_status === 'bidding')
                                <span
                                    class="inline-block px-3 py-1 text-xs font-medium bg-amber-500 text-white rounded-full shadow-sm">Bidding</span>
                            @else
                                <span
                                    class="inline-block px-3 py-1 text-xs font-medium bg-zinc-500 text-white rounded-full shadow-sm">Available</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
