<section id="teams" class="max-w-7xl mx-auto px-4 sm:px-6 py-16">
    <div class="text-center mb-10">
        <p class="text-maroon font-semibold tracking-widest text-xs">দলসমূহ</p>
        <h2 class="font-display font-700 text-3xl sm:text-4xl mt-1">MPL ২০২৬ — অংশগ্রহণকারী দল</h2>
        <p class="text-ink/50 text-sm mt-2">যেকোনো দলে ক্লিক করলে দলের বিস্তারিত তথ্য, স্কোয়াড ও ম্যাচ দেখা যাবে</p>
    </div>

    <div id="teamGrid" class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5">
        @foreach ($teams as $team)
        <a href=""
            class="block bg-pitchdark rounded-2xl p-5 text-cream border border-gold/20 hover:-translate-y-1 hover:border-gold transition cursor-pointer">

            <div
                class="w-14 h-14 rounded-full bg-gold text-pitchdark font-display font-800 text-xl flex items-center justify-center mb-4 overflow-hidden">
                @if ($team->logo)
                <img src="{{ asset('storage/' . $team->logo) }}" alt="{{ $team->name }}"
                    class="w-full h-full object-cover rounded-full">
                @else
                {{ Str::upper(Str::substr($team->name, 0, 2)) }}
                @endif
            </div>

            <h3 class="font-display font-700 text-lg">{{ $team->name }}</h3>

            {{-- Details --}}
            <p class="text-cream/60 text-sm mt-1">Owner: {{ $team->owner_name ?? 'N/A' }}</p>
            <p class="text-cream/60 text-sm">
                খেলোয়াড়: {{ $team->players_count ?? $team->players->count() }} জন · এলাকা: {{ $team->district }}, {{
                $team->village}}
            </p>

            {{-- Action Link --}}
            <a href="{{ route('tournament.fixture')}}" class="text-gold text-xs font-semibold mt-3">বিস্তারিত দেখুন
                →</a>
        </a>
        @endforeach
    </div>
</section>