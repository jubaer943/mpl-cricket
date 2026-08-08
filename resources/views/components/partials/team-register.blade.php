<section class="py-12 px-4 sm:px-6 lg:px-8 bg-cream/50 min-h-screen">
    <div class="bg-cream rounded-3xl w-full max-w-3xl mx-auto border border-ink/10 p-6 sm:p-10 shadow-lg">

        <!-- Form Header -->
        <div class="mb-8 text-center">
            <h2 class="font-display font-bold text-3xl sm:text-4xl text-ink mb-2">দল নিবন্ধন ফর্ম</h2>
            <p class="text-ink/60 text-base">আপনার দলের তথ্যগুলো সঠিকভাবে পূরণ করুন।</p>
        </div>

        <!-- Registration Form -->
        <form onsubmit="return submitForm(event, 'team')" class="space-y-5">

            <!-- Basic Info -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-ink/80 mb-1.5">দলের নাম</label>
                    <input required type="text" placeholder="যেমনঃ মজমপুর টাইগার্স"
                        class="w-full rounded-xl border border-ink/15 px-4 py-3 bg-white focus:border-gold outline-none transition">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-ink/80 mb-1.5">মালিকের নাম</label>
                    <input required type="text" placeholder="মালিকের পূর্ণ নাম"
                        class="w-full rounded-xl border border-ink/15 px-4 py-3 bg-white focus:border-gold outline-none transition">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-ink/80 mb-1.5">পিতার নাম</label>
                    <input required type="text"
                        class="w-full rounded-xl border border-ink/15 px-4 py-3 bg-white focus:border-gold outline-none transition">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-ink/80 mb-1.5">মাতার নাম</label>
                    <input required type="text"
                        class="w-full rounded-xl border border-ink/15 px-4 py-3 bg-white focus:border-gold outline-none transition">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-ink/80 mb-1.5">বয়স</label>
                    <input required type="number" min="15" max="100"
                        class="w-full rounded-xl border border-ink/15 px-4 py-3 bg-white focus:border-gold outline-none transition">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-ink/80 mb-1.5">জাতীয়তা</label>
                    <input required type="text" value="বাংলাদেশী"
                        class="w-full rounded-xl border border-ink/15 px-4 py-3 bg-white focus:border-gold outline-none transition">
                </div>
            </div>

            <!-- Location Info -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 pt-4 border-t border-ink/10">
                <div>
                    <label class="block text-sm font-semibold text-ink/80 mb-1.5">গ্রাম</label>
                    <input required type="text"
                        class="w-full rounded-xl border border-ink/15 px-4 py-3 bg-white focus:border-gold outline-none transition">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-ink/80 mb-1.5">ডাকঘর</label>
                    <input required type="text"
                        class="w-full rounded-xl border border-ink/15 px-4 py-3 bg-white focus:border-gold outline-none transition">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-ink/80 mb-1.5">থানা</label>
                    <input required type="text"
                        class="w-full rounded-xl border border-ink/15 px-4 py-3 bg-white focus:border-gold outline-none transition">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-ink/80 mb-1.5">জেলা</label>
                    <input required type="text"
                        class="w-full rounded-xl border border-ink/15 px-4 py-3 bg-white focus:border-gold outline-none transition">
                </div>
            </div>

            <!-- Checkbox -->
            <div class="flex items-center gap-3 pt-2">
                <input required type="checkbox" id="terms"
                    class="w-5 h-5 accent-pitch rounded border-ink/15 cursor-pointer">
                <label for="terms" class="text-sm text-ink/70 cursor-pointer">
                    আমি নিবন্ধনের সকল শর্তাবলি এবং নিয়মাবলির সাথে একমত।
                </label>
            </div>

            <!-- Submit Button -->
            <button type="submit"
                class="w-full mt-6 px-6 py-4 rounded-full bg-pitch text-cream font-bold hover:bg-pitchdark transition shadow-lg text-lg">
                নিবন্ধন সম্পন্ন করুন
            </button>
        </form>
    </div>
</section>
