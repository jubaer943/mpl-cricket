<section id="hero" class="relative bg-gradient-to-b from-pitchdark to-pitch overflow-hidden">

    <div class="absolute inset-0 flex items-center justify-center opacity-10 pointer-events-none">
        <img src="{{ asset('img/logo.jpg') }}" alt="Ekota Jubo Sangha Logo" class="h-96 w-auto">
    </div>

    <div class="absolute inset-0 opacity-[0.07]"
        style="background-image: radial-gradient(circle, #FBF3E1 1.5px, transparent 1.5px); background-size: 22px 22px;">
    </div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 pt-16 pb-20 text-center">
        <h1 style="font-size:25px ;" class=" inline-block text-gold font-semibold ">একতা
            যুব
            সংঘ
            আয়োজিত</h1>
        <br>
        <p class="rise rise-1 inline-block text-gold font-semibold tracking-[0.25em] text-xs sm:text-sm mb-4">
            মঞ্জুরুল হক চৌধুরী রতনের অনুপ্রেরণায়</p>
        <h1 class="rise rise-2 font-display font-800 text-cream text-4xl sm:text-6xl leading-tight">
            মজমপুর প্রিমিয়ার ক্রিকেট লীগ
        </h1>
        <p class="rise rise-2 font-display text-gold text-2xl sm:text-3xl mt-1 tracking-wide">MPL ২০২৬</p>
        <p class="rise rise-3 text-cream/80 max-w-2xl mx-auto mt-5 text-base sm:text-lg">
            একসাথে খেলি, একসাথে গড়ি সুস্থ শরীর সুন্দর সমাজ
        </p>
        <div class="rise rise-3 flex flex-wrap gap-4 justify-center mt-8">
            <button onclick="openModal('teamModal')"
                class="px-7 py-3 rounded-full bg-gold text-pitchdark font-bold hover:bg-goldlight transition shadow-lg shadow-black/20">দল
                নিবন্ধন করুন</button>
            <button onclick="openModal('playerModal')"
                class="px-7 py-3 rounded-full border-2 border-cream/40 text-cream font-bold hover:border-gold hover:text-gold transition">খেলোয়াড়
                নিবন্ধন করুন</button>
        </div>

        <!-- stat tiles -->
        <div class="rise rise-4 grid grid-cols-2 sm:grid-cols-4 gap-3 sm:gap-4 max-w-3xl mx-auto mt-14">
            <div class="bg-pitchdeep/60 border border-gold/25 rounded-2xl py-5">
                <p class="font-display font-800 text-gold text-3xl">6</p>
                <p class="text-cream/70 text-sm mt-1">অংশগ্রহণকারী দল</p>
            </div>
            <div class="bg-pitchdeep/60 border border-gold/25 rounded-2xl py-5">
                <p class="font-display font-800 text-gold text-3xl">০+</p>
                <p class="text-cream/70 text-sm mt-1">নিবন্ধিত খেলোয়াড়</p>
            </div>
            <div class="bg-pitchdeep/60 border border-gold/25 rounded-2xl py-5">
                <p class="font-display font-800 text-gold text-3xl">0</p>
                <p class="text-cream/70 text-sm mt-1">মোট ম্যাচ</p>
            </div>
            <div class="bg-pitchdeep/60 border border-gold/25 rounded-2xl py-5">
                <p class="font-display font-800 text-gold text-3xl">1</p>
                <p class="text-cream/70 text-sm mt-1">ভেন্যু</p>
            </div>
        </div>
    </div>
</section>
<div class="seam seam-gold bg-pitch"></div>
