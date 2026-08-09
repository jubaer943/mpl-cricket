<section class="py-12 px-4 sm:px-6 lg:px-8 bg-cream/50 min-h-screen">
    <div class="bg-cream rounded-3xl w-full max-w-3xl mx-auto border border-ink/10 p-6 sm:p-10 shadow-lg">

        <!-- Form Header -->
        <div class="mb-8 text-center">
            <h2 class="font-display font-bold text-3xl sm:text-4xl text-ink mb-2">দল নিবন্ধন ফর্ম</h2>
            <p class="text-ink/60 text-base">আপনার দলের তথ্যগুলো সঠিকভাবে পূরণ করুন।</p>
        </div>

        <!-- Registration Form -->
        <form action="{{ route('team.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf

            <!-- Basic Info -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                <!-- Team Logo Field -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-ink/80 mb-1.5">টিম লোগো</label>
                    <input required type="file" name="team_logo" accept="image/*"
                        class="w-full rounded-xl border border-ink/15 px-4 py-3 bg-white focus:border-gold outline-none transition file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-pitch file:text-cream hover:file:bg-pitchdark cursor-pointer">
                    @error('team_logo')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-ink/80 mb-1.5">দলের নাম</label>
                    <input required type="text" name="team_name" value="{{ old('team_name') }}"
                        placeholder="যেমনঃ মজমপুর টাইগার্স"
                        class="w-full rounded-xl border border-ink/15 px-4 py-3 bg-white focus:border-gold outline-none transition">
                    @error('team_name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-ink/80 mb-1.5">মালিকের নাম</label>
                    <input required type="text" name="owner_name" value="{{ old('owner_name') }}"
                        placeholder="মালিকের পূর্ণ নাম"
                        class="w-full rounded-xl border border-ink/15 px-4 py-3 bg-white focus:border-gold outline-none transition">
                    @error('owner_name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-ink/80 mb-1.5">জাতীয়তা</label>
                    <input required type="text" name="nationality" value="{{ old('nationality', 'বাংলাদেশী') }}"
                        class="w-full rounded-xl border border-ink/15 px-4 py-3 bg-white focus:border-gold outline-none transition">
                    @error('nationality')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Location Info -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 pt-4 border-t border-ink/10">
                <div>
                    <label class="block text-sm font-semibold text-ink/80 mb-1.5">গ্রাম</label>
                    <input required type="text" name="village" value="{{ old('village') }}"
                        class="w-full rounded-xl border border-ink/15 px-4 py-3 bg-white focus:border-gold outline-none transition">
                    @error('village')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-ink/80 mb-1.5">ডাকঘর</label>
                    <input required type="text" name="post_office" value="{{ old('post_office') }}"
                        class="w-full rounded-xl border border-ink/15 px-4 py-3 bg-white focus:border-gold outline-none transition">
                    @error('post_office')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-ink/80 mb-1.5">থানা</label>
                    <input required type="text" name="police_station" value="{{ old('police_station') }}"
                        class="w-full rounded-xl border border-ink/15 px-4 py-3 bg-white focus:border-gold outline-none transition">
                    @error('police_station')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-ink/80 mb-1.5">জেলা</label>
                    <input required type="text" name="district" value="{{ old('district') }}"
                        class="w-full rounded-xl border border-ink/15 px-4 py-3 bg-white focus:border-gold outline-none transition">
                    @error('district')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Checkbox -->
            <div class="flex items-center gap-3 pt-2">
                <input required type="checkbox" id="terms" name="terms" value="1"
                    class="w-5 h-5 accent-pitch rounded border-ink/15 cursor-pointer">
                <label for="terms" class="text-sm text-ink/70 cursor-pointer">
                    আমি নিবন্ধনের সকল শর্তাবলি এবং নিয়মাবলির সাথে একমত।
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
