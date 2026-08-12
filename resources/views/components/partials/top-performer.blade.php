<div class="seam seam-gold bg-creamdark"></div>

<section id="playersPreview" class="bg-creamdark py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="text-center mb-10">
            <p class="text-maroon font-semibold tracking-widest text-xs">খেলোয়াড়</p>
            <h2 class="font-display font-700 text-3xl sm:text-4xl mt-1">শীর্ষ পারফর্মার</h2>
        </div>

        <div class="overflow-x-auto rounded-2xl border border-ink/10 bg-cream shadow-sm">
            <table class="min-w-full text-sm">
                <thead class="bg-pitchdark text-cream">
                    <tr>
                        <th class="px-4 py-3 text-left font-display font-600">নাম</th>
                        <th class="px-4 py-3 text-left font-display font-600">দল</th>
                        <th class="px-4 py-3 text-left font-display font-600">ভূমিকা</th>
                        <th class="px-4 py-3 text-center font-display font-600">ম্যাচ</th>
                        <th class="px-4 py-3 text-center font-display font-600">রান</th>
                        <th class="px-4 py-3 text-center font-display font-600">উইকেট</th>
                    </tr>
                </thead>
                <tbody id="playersPreviewBody" class="divide-y divide-ink/10" data-done="1">
                    @forelse($players as $player)
                    <tr class="hover:bg-goldlight/20">
                        <td class="px-4 py-3 font-medium">{{ $player->name }}</td>
                        <td class="px-4 py-3">-</td>
                        <td class="px-4 py-3">{{ $player->player_role }}</td>
                        <td class="px-4 py-3 text-center">-</td>
                        <td class="px-4 py-3 text-center font-semibold text-pitch"></td>
                        <td class="px-4 py-3 text-center ">
                            -
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-4 py-3 text-center text-gray-500">
                            কোনো খেলোয়াড়ের তথ্য পাওয়া যায়নি।
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="text-center mt-6">
            {{-- <p class="text-ink/50 text-sm mb-4">সম্পূর্ণ তালিকায় ১৪০ জনের বেশি খেলোয়াড় রয়েছে — উপরে শীর্ষ
                পারফর্মারদের একাংশ দেখানো হলো।</p> --}}
            <button onclick="go('players')"
                class="px-6 py-2.5 rounded-full bg-pitch text-cream font-semibold hover:bg-pitchdark transition">সব
                খেলোয়াড় দেখুন →</button>
        </div>
    </div>
</section>