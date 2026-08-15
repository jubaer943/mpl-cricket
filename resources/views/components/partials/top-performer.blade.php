<div class="seam seam-gold bg-creamdark"></div>

<section id="playersPreview" class="bg-creamdark py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="text-center mb-10">
            <p class="text-maroon font-semibold tracking-widest text-xs">খেলোয়াড়</p>
            <h2 class="font-display font-700 text-3xl sm:text-4xl mt-1">শীর্ষ পারফর্মার</h2>
        </div>

        <x-partials.players.performance-table />
        <div class="text-center mt-6">
            {{-- <p class="text-ink/50 text-sm mb-4">সম্পূর্ণ তালিকায় ১৪০ জনের বেশি খেলোয়াড় রয়েছে — উপরে শীর্ষ
                পারফর্মারদের একাংশ দেখানো হলো।</p> --}}
            <button onclick="go('players')"
                class="px-6 py-2.5 rounded-full bg-pitch text-cream font-semibold hover:bg-pitchdark transition">সব
                খেলোয়াড় দেখুন →</button>
        </div>
    </div>
</section>