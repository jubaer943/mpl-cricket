<x-filament-panels::page>
    <div class="space-y-6">

        <!-- ১. ক্যাটাগরি সিলেক্টর -->
        <div class="bg-white p-4 rounded-xl shadow border border-gray-200 flex items-center justify-between">
            <label class="font-bold text-gray-700">ক্যাটাগরি ফিল্টার করুন:</label>
            <select wire:model.live="selectedCategoryId"
                class="rounded-lg border-gray-300 text-sm focus:ring-primary-500">
                @foreach (\App\Models\Category::all() as $category)
                    <option value="{{ $category->id }}">{{ $category->name }} (Base: {{ $category->base_price }} BDT)
                    </option>
                @endforeach
            </select>
        </div>

        @if ($currentPlayer)
            <!-- ২. কারেন্ট প্লেয়ার ডিসপ্লে ও নিলাম কার্ড -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-white p-6 rounded-2xl shadow-lg border border-gray-100">

                <!-- প্লেয়ারের ছবি ও ইনফো -->
                <div class="flex flex-col items-center text-center space-y-3 border-r pr-4">
                    <img src="{{ asset('storage/' . $currentPlayer->photo) }}"
                        class="w-48 h-48 rounded-2xl object-cover shadow-md border-4 border-primary-500">
                    <h2 class="text-2xl font-black text-gray-800">{{ $currentPlayer->name }}</h2>
                    <div class="flex gap-2">
                        <span
                            class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-xs font-bold">{{ $currentPlayer->player_role }}</span>
                        <span
                            class="px-3 py-1 bg-amber-100 text-amber-800 rounded-full text-xs font-bold">{{ $currentPlayer->batting_style }}</span>
                        <span
                            class="px-3 py-1 bg-purple-100 text-purple-800 rounded-full text-xs font-bold">{{ $currentPlayer->grade }}</span>
                    </div>
                    <p class="text-sm text-gray-500">পূর্বের দল: {{ $currentPlayer->past_team ?? 'N/A' }}</p>
                </div>

                <!-- নিলাম কন্ট্রোল ও বিডিং বোর্ড -->
                <div class="flex flex-col justify-between space-y-6">
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">বর্তমান বিড মূল্য</p>
                        <h1 class="text-5xl font-black text-emerald-600 mt-1">৳ {{ number_format($currentBidPrice) }}
                        </h1>
                        <p class="text-xs text-gray-400 mt-1">প্রতি বিডে বাড়বে: ৳
                            {{ $currentPlayer->category->bid_increment }}</p>
                    </div>

                    <!-- বিড ইনক্রিমেন্ট বাটন -->
                    <div>
                        <button wire:click="incrementBid" type="button"
                            class="w-full py-3 bg-emerald-500 hover:bg-emerald-600 text-white font-bold rounded-xl shadow-lg text-lg transition">
                            + ৳ {{ $currentPlayer->category->bid_increment }} দাম বাড়ান
                        </button>
                    </div>

                    <!-- টিম সিলেক্ট ও Sold / Unsold অপশন -->
                    <div class="space-y-3 pt-4 border-t">
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1">কোন টিমের কাছে বিক্রি
                                হবে?</label>
                            <select wire:model="selectedTeamId"
                                class="w-full rounded-xl border-gray-300 text-sm focus:ring-primary-500">
                                <option value="">টিম নির্বাচন করুন...</option>
                                @foreach (\App\Models\Team::all() as $team)
                                    <option value="{{ $team->id }}">{{ $team->name }} (প্লেয়ার আছে:
                                        {{ $team->players_count ?? $team->players()->count() }}/১৫)</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="grid grid-cols-2 gap-3">
                            <button wire:click="sellPlayer" type="button"
                                class="py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl shadow transition">
                                SOLD (বিক্রি করুন)
                            </button>
                            <button wire:click="markUnsold" type="button"
                                class="py-3 bg-red-500 hover:bg-red-600 text-white font-bold rounded-xl shadow transition">
                                UNSOLD
                            </button>
                        </div>
                    </div>

                    <!-- স্কিপ বা পরবর্তী প্লেয়ার -->
                    <button wire:click="loadNextPlayer" type="button"
                        class="text-xs text-gray-500 underline text-center block w-full hover:text-gray-800">
                        পরবর্তী প্লেয়ারে স্কিপ করুন →
                    </button>
                </div>
            </div>
        @else
            <!-- প্লেয়ার না থাকলে দেখাবে -->
            <div class="bg-amber-50 border border-amber-200 text-amber-800 p-8 rounded-2xl text-center">
                <h3 class="text-xl font-bold">এই ক্যাটাগরিতে নিলামের জন্য আর কোনো Available প্লেয়ার নেই!</h3>
                <p class="text-sm mt-1">অন্য ক্যাটাগরি নির্বাচন করুন অথবা নতুন প্লেয়ার এপ্রুভ করুন।</p>
            </div>
        @endif

    </div>
</x-filament-panels::page>
