<section id="gallery" class="max-w-7xl mx-auto px-4 sm:px-6 py-14">
    <div class="text-center mb-8">
        <p class="text-maroon font-semibold tracking-widest text-xs">গ্যালারি</p>
        <h2 class="font-display font-700 text-3xl sm:text-4xl mt-1">ক্লাবের ছবি</h2>
    </div>

    <div class="relative rounded-3xl overflow-hidden shadow-xl">
        <div id="carouselTrack" class="flex">
            <div class="min-w-full relative">
                <img src="https://picsum.photos/seed/mpl-open/1200/560" alt="উদ্বোধনী অনুষ্ঠান"
                    class="w-full h-72 sm:h-[420px] object-cover">
                <div class="absolute bottom-0 inset-x-0 bg-gradient-to-t from-ink/80 to-transparent p-5">
                    <p class="text-cream font-display font-600 text-xl">উদ্বোধনী অনুষ্ঠান, MPL ২০২৬</p>
                </div>
            </div>
            <div class="min-w-full relative">
                <img src="https://picsum.photos/seed/mpl-match/1200/560" alt="মাঠে খেলা চলছে"
                    class="w-full h-72 sm:h-[420px] object-cover">
                <div class="absolute bottom-0 inset-x-0 bg-gradient-to-t from-ink/80 to-transparent p-5">
                    <p class="text-cream font-display font-600 text-xl">উপজেলা স্টেডিয়ামে খেলা</p>
                </div>
            </div>
            <div class="min-w-full relative">
                <img src="https://picsum.photos/seed/mpl-team/1200/560" alt="দলের ছবি"
                    class="w-full h-72 sm:h-[420px] object-cover">
                <div class="absolute bottom-0 inset-x-0 bg-gradient-to-t from-ink/80 to-transparent p-5">
                    <p class="text-cream font-display font-600 text-xl">মজমপুর টাইগার্স দল</p>
                </div>
            </div>
            <div class="min-w-full relative">
                <img src="https://picsum.photos/seed/mpl-trophy/1200/560" alt="ট্রফি প্রদান"
                    class="w-full h-72 sm:h-[420px] object-cover">
                <div class="absolute bottom-0 inset-x-0 bg-gradient-to-t from-ink/80 to-transparent p-5">
                    <p class="text-cream font-display font-600 text-xl">গত মৌসুমের ট্রফি বিতরণ</p>
                </div>
            </div>
            <div class="min-w-full relative">
                <img src="https://picsum.photos/seed/mpl-crowd/1200/560" alt="দর্শকদের ভিড়"
                    class="w-full h-72 sm:h-[420px] object-cover">
                <div class="absolute bottom-0 inset-x-0 bg-gradient-to-t from-ink/80 to-transparent p-5">
                    <p class="text-cream font-display font-600 text-xl">গ্যালারিতে দর্শকদের উচ্ছ্বাস</p>
                </div>
            </div>
        </div>

        <button onclick="moveSlide(-1)" aria-label="পূর্ববর্তী ছবি"
            class="absolute left-3 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-cream/90 hover:bg-gold text-ink flex items-center justify-center text-lg shadow">‹</button>
        <button onclick="moveSlide(1)" aria-label="পরবর্তী ছবি"
            class="absolute right-3 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-cream/90 hover:bg-gold text-ink flex items-center justify-center text-lg shadow">›</button>

        <div id="carouselDots" class="absolute bottom-3 right-4 flex gap-2"></div>
    </div>
</section>
