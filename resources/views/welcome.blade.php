<x-layouts.master>

    <div id="page-home" class="page">
        <x-partials.hero :playerTotal="$playerTotal" />
        <x-partials.gallery />
        <x-partials.registration-promt />
        <x-partials.team :teams="$teams" />
        <x-partials.top-performer />
        <x-partials.matches />
        <x-partials.point-table />
        <x-partials.tournament :tournaments="$tournaments" />
        <x-partials.fixture />
        <x-partials.committee />
    </div>
    <script>
        window.playersData = @json($playerData['topPerformers'] ?? []);
    </script>
    <script src="{{ asset('js/players/performance-table.js') }}"></script>
</x-layouts.master>