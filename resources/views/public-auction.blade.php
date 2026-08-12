<!DOCTYPE html>
<html lang="bn">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>লাইভ ড্রাফটিং ও নিলাম</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-slate-950 text-white min-h-screen flex items-center justify-center p-4">

    <div x-data="publicAuction()" x-init="startLiveDraft()"
        class="w-full max-w-3xl bg-slate-900 rounded-3xl p-6 md:p-8 border border-slate-800 shadow-2xl">

        <!-- Header -->
        <div class="flex items-center justify-between border-b border-slate-800 pb-4 mb-6">
            <div class="flex items-center gap-3">
                <span class="relative flex h-3.5 w-3.5">
                    <span
                        class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-3.5 w-3.5 bg-red-500"></span>
                </span>
                <h1 class="text-xl font-black text-amber-400 tracking-wide">লাইভ প্লেয়ার ড্রাফট (MPL)</h1>
            </div>
            <span class="text-xs px-3 py-1 bg-slate-800 text-slate-300 font-bold rounded-full">Live Stream</span>
        </div>

        <template x-if="isLive && player">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">

                <!-- Player Photo & Bio -->
                <div class="flex flex-col items-center text-center space-y-3">
                    <div class="relative">
                        <img :src="player.photo"
                            class="w-48 h-48 md:w-56 md:h-56 rounded-2xl object-cover border-4 border-amber-400 shadow-2xl">
                        <span
                            class="absolute top-2 right-2 px-3 py-1 bg-amber-500 text-slate-950 font-black text-xs rounded-full shadow"
                            x-text="player.category_name"></span>
                    </div>

                    <h2 class="text-2xl md:text-3xl font-black text-white" x-text="player.name"></h2>

                    <div class="flex flex-wrap justify-center gap-2">
                        <span class="px-3 py-1 bg-slate-800 text-amber-300 text-xs font-semibold rounded-lg"
                            x-text="player.role"></span>
                        <span class="px-3 py-1 bg-slate-800 text-emerald-300 text-xs font-semibold rounded-lg"
                            x-text="player.batting_style"></span>
                        <span class="px-3 py-1 bg-slate-800 text-blue-300 text-xs font-semibold rounded-lg"
                            x-text="player.grade"></span>
                    </div>
                </div>

                <!-- Bidding Panel -->
                <div class="bg-slate-950/80 p-6 rounded-2xl border border-slate-800 space-y-6">
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">বর্তমান বিড মূল্য</p>
                        <h1 class="text-4xl md:text-5xl font-black text-emerald-400 mt-1">
                            ৳ <span x-text="Number(player.current_price).toLocaleString()"></span>
                        </h1>
                        <p class="text-xs text-amber-400 mt-2 font-semibold">
                            প্রতি বিডে বাড়বে: +৳ <span x-text="player.bid_increment"></span>
                        </p>
                    </div>

                    <!-- 1. Bidding in Progress / Current Team -->
                    <template x-if="player.auction_status === 'bidding' || player.auction_status === 'available'">
                        <div class="p-4 bg-blue-500/10 border border-blue-500/30 rounded-2xl">
                            <p class="text-xs text-blue-400 font-bold uppercase tracking-wider mb-1">সর্বশেষ বিডকারী টিম
                            </p>

                            <template x-if="player.bidding_team_name">
                                <div class="flex items-center gap-3">
                                    <template x-if="player.bidding_team_logo">
                                        <img :src="player.bidding_team_logo" class="w-8 h-8 rounded-full object-cover">
                                    </template>
                                    <h3 class="text-lg font-black text-blue-300" x-text="player.bidding_team_name"></h3>
                                </div>
                            </template>

                            <template x-if="!player.bidding_team_name">
                                <p class="text-xs text-amber-400 font-bold">বিডিংয়ের জন্য অপেক্ষা করা হচ্ছে...</p>
                            </template>
                        </div>
                    </template>

                    <!-- 2. SOLD -->
                    <template x-if="player.auction_status === 'sold'">
                        <div
                            class="p-4 bg-emerald-500/10 border border-emerald-500/40 rounded-2xl flex items-center gap-4">
                            <template x-if="player.bidding_team_logo">
                                <img :src="player.bidding_team_logo"
                                    class="w-12 h-12 rounded-full object-cover border-2 border-emerald-400">
                            </template>
                            <div>
                                <span class="text-xs text-emerald-400 font-black tracking-wider uppercase">SOLD
                                    TO</span>
                                <h3 class="text-xl font-black text-emerald-300" x-text="player.bidding_team_name"></h3>
                            </div>
                        </div>
                    </template>

                    <!-- 3. UNSOLD -->
                    <template x-if="player.auction_status === 'unsold'">
                        <div
                            class="p-4 bg-red-500/10 border border-red-500/30 rounded-2xl text-center text-red-400 font-black text-lg">
                            UNSOLD (বিক্রি হয়নি)
                        </div>
                    </template>
                </div>

            </div>
        </template>

        <template x-if="!isLive">
            <div class="py-16 text-center text-slate-400 font-bold">
                currently no active player bidding.
            </div>
        </template>

    </div>

    <script>
        function publicAuction() {
            return {
                isLive: false,
                player: null,
                fetchData() {
                    fetch('/api/live-draft-data')
                        .then(res => res.json())
                        .then(data => {
                            this.isLive = data.is_live;
                            this.player = data.player;
                        });
                },
                startLiveDraft() {
                    this.fetchData();
                    setInterval(() => this.fetchData(), 1500);
                }
            }
        }
    </script>
</body>

</html>