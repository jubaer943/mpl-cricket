<x-layouts.master>

    <div id="page-home" class="page">
        <x-partials.hero />
        <x-partials.gallery />
        <x-partials.registration-promt />
        <x-partials.team :teams="$teams" />
        <x-partials.top-performer :players="$players" />
        <x-partials.matches />
        <x-partials.point-table />
        <x-partials.fixture />
        <x-partials.committee />
    </div>

</x-layouts.master>