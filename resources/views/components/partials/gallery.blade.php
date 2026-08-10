<section id="gallery" class="max-w-7xl mx-auto px-4 sm:px-6 py-14">
    <div class="text-center mb-8">
        <h2 class="text-maroon font-semibold tracking-widest text-xs font-display font-700 text-3xl sm:text-4xl mt-1">
            গ্যালারি</h2>
        {{-- <h2 class="font-display font-700 text-3xl sm:text-4xl mt-1">ক্লাবের ছবি</h2> --}}
    </div>

    <div class="relative rounded-3xl overflow-hidden shadow-xl">
        <div id="carouselTrack" class="flex">
            <div class="min-w-full relative">
                <img src="{{ asset('img/img_1.jpg') }}" alt="উদ্বোধনী অনুষ্ঠান"
                    class="w-full h-72 sm:h-[420px] object-cover">
                <div class="absolute bottom-0 inset-x-0 bg-gradient-to-t from-ink/80 to-transparent p-5">
                    <p class="text-cream font-display font-600 text-xl">উদ্বোধনী অনুষ্ঠান, MPL ২০২৬</p>
                </div>
            </div>
            <div class="min-w-full relative">
                <img src="{{ asset('img/img_1.jpg') }}" alt="মাঠে খেলা চলছে"
                    class="w-full h-72 sm:h-[420px] object-cover">
                <div class="absolute bottom-0 inset-x-0 bg-gradient-to-t from-ink/80 to-transparent p-5">
                    <p class="text-cream font-display font-600 text-xl">উপজেলা স্টেডিয়ামে খেলা</p>
                </div>
            </div>
            <div class="min-w-full relative">
                <img src="{{ asset('img/img_2.jpg') }}" alt="দলের ছবি" class="w-full h-72 sm:h-[420px] object-cover">
                <div class="absolute bottom-0 inset-x-0 bg-gradient-to-t from-ink/80 to-transparent p-5">
                    <p class="text-cream font-display font-600 text-xl">মজমপুর টাইগার্স দল</p>
                </div>
            </div>
            <div class="min-w-full relative">
                <img src="{{ asset('img/img_3.jpg') }}" alt="ট্রফি প্রদান"
                    class="w-full h-72 sm:h-[420px] object-cover">
                <div class="absolute bottom-0 inset-x-0 bg-gradient-to-t from-ink/80 to-transparent p-5">
                    <p class="text-cream font-display font-600 text-xl">গত মৌসুমের ট্রফি বিতরণ</p>
                </div>
            </div>
            <div class="min-w-full relative">
                <img src="{{ asset('img/img_4.jpg') }}" alt="দর্শকদের ভিড়"
                    class="w-full h-72 sm:h-[420px] object-cover">
                <div class="absolute bottom-0 inset-x-0 bg-gradient-to-t from-ink/80 to-transparent p-5">
                    <p class="text-cream font-display font-600 text-xl">গ্যালারিতে দর্শকদের উচ্ছ্বাস</p>
                </div>
            </div>
            <div class="min-w-full relative">
                <img src="{{ asset('img/img_6.jpg') }}" alt="দর্শকদের ভিড়"
                    class="w-full h-72 sm:h-[420px] object-cover">
                <div class="absolute bottom-0 inset-x-0 bg-gradient-to-t from-ink/80 to-transparent p-5">
                    <p class="text-cream font-display font-600 text-xl">গ্যালারিতে দর্শকদের উচ্ছ্বাস</p>
                </div>
            </div>
            <div class="min-w-full relative">
                <img src="{{ asset('img/logo.jpg') }}" alt="দর্শকদের ভিড়"
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

<script>
    // ---------- carousel ----------
    const track = document.getElementById('carouselTrack');
    const slideCount = track.children.length;
    let currentSlide = 0;
    const dotsWrap = document.getElementById('carouselDots');
    for (let i = 0; i < slideCount; i++) {
        const dot = document.createElement('button');
        dot.className = 'w-2.5 h-2.5 rounded-full bg-cream/60 hover:bg-gold transition';
        dot.setAttribute('aria-label', 'ছবি ' + (i + 1));
        dot.onclick = () => goToSlide(i);
        dotsWrap.appendChild(dot);
    }

    function updateDots() {
        Array.from(dotsWrap.children).forEach((d, i) => {
            d.classList.toggle('bg-gold', i === currentSlide);
            d.classList.toggle('bg-cream/60', i !== currentSlide);
        });
    }

    function goToSlide(i) {
        currentSlide = (i + slideCount) % slideCount;
        track.style.transform = 'translateX(' + (-currentSlide * 100) + '%)';
        updateDots();
    }

    function moveSlide(dir) {
        goToSlide(currentSlide + dir);
    }
    updateDots();
    let autoSlide = setInterval(() => moveSlide(1), 4500);
    track.parentElement.addEventListener('mouseenter', () => clearInterval(autoSlide));
    track.parentElement.addEventListener('mouseleave', () => {
        autoSlide = setInterval(() => moveSlide(1), 4500);
    });
</script>
