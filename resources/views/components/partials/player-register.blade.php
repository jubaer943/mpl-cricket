<section class="py-12 px-4 sm:px-6 lg:px-8 bg-cream/50 min-h-screen">
    <div class="bg-cream rounded-3xl w-full max-w-3xl mx-auto border border-ink/10 p-6 sm:p-10 shadow-lg">

        <!-- Form Header -->
        <div class="mb-8 text-center">
            <h2 class="font-display font-bold text-3xl sm:text-4xl text-ink mb-2">খেলোয়াড় নিবন্ধন ফর্ম</h2>
            <p class="text-ink/60 text-base">টুর্নামেন্টে অংশগ্রহণের জন্য প্লেয়ারের সঠিক তথ্য ও ফি প্রদান করুন।</p>
        </div>

        <!-- Registration Form -->
        <form onsubmit="return submitForm(event, 'player')" class="space-y-6" enctype="multipart/form-data">

            <!-- Personal Info Section -->
            <div>
                <h3 class="text-lg font-bold text-ink mb-4 pb-1 border-b border-ink/10">ব্যক্তিগত তথ্য ও ছবি</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <!-- Player Photo -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-ink/80 mb-1.5">প্লেয়ারের ছবি (Passport Size
                            Photo)</label>
                        <input required type="file" accept="image/*"
                            class="w-full rounded-xl border border-ink/15 px-4 py-2.5 bg-white text-sm file:mr-4 file:py-1.5 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-pitch file:text-cream hover:file:bg-pitchdark transition cursor-pointer">
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-ink/80 mb-1.5">প্লেয়ারের নাম</label>
                        <input required type="text" placeholder="পূর্ণ নাম লিখুন"
                            class="w-full rounded-xl border border-ink/15 px-4 py-3 bg-white focus:border-gold outline-none transition">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-ink/80 mb-1.5">পিতার নাম</label>
                        <input required type="text" placeholder="পিতার নাম"
                            class="w-full rounded-xl border border-ink/15 px-4 py-3 bg-white focus:border-gold outline-none transition">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-ink/80 mb-1.5">মাতার নাম</label>
                        <input required type="text" placeholder="মাতার নাম"
                            class="w-full rounded-xl border border-ink/15 px-4 py-3 bg-white focus:border-gold outline-none transition">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-ink/80 mb-1.5">মোবাইল নম্বর</label>
                        <input required type="tel" placeholder="01XXXXXXXXX"
                            class="w-full rounded-xl border border-ink/15 px-4 py-3 bg-white focus:border-gold outline-none transition">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-ink/80 mb-1.5">জন্ম তারিখ</label>
                        <input required type="date"
                            class="w-full rounded-xl border border-ink/15 px-4 py-3 bg-white focus:border-gold outline-none transition text-ink/80">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-ink/80 mb-1.5">জাতীয়তা</label>
                        <input required type="text" value="বাংলাদেশী"
                            class="w-full rounded-xl border border-ink/15 px-4 py-3 bg-white focus:border-gold outline-none transition">
                    </div>
                </div>
            </div>

            <!-- Address Section -->
            <div>
                <h3 class="text-lg font-bold text-ink mb-4 pb-1 border-b border-ink/10">ঠিকানা</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-semibold text-ink/80 mb-1.5">গ্রাম</label>
                        <input required type="text" placeholder="গ্রামের নাম"
                            class="w-full rounded-xl border border-ink/15 px-4 py-3 bg-white focus:border-gold outline-none transition">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-ink/80 mb-1.5">ডাকঘর</label>
                        <input required type="text" placeholder="ডাকঘর"
                            class="w-full rounded-xl border border-ink/15 px-4 py-3 bg-white focus:border-gold outline-none transition">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-ink/80 mb-1.5">থানা</label>
                        <input required type="text" placeholder="থানার নাম"
                            class="w-full rounded-xl border border-ink/15 px-4 py-3 bg-white focus:border-gold outline-none transition">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-ink/80 mb-1.5">জেলা</label>
                        <input required type="text" placeholder="জেলার নাম"
                            class="w-full rounded-xl border border-ink/15 px-4 py-3 bg-white focus:border-gold outline-none transition">
                    </div>
                </div>
            </div>

            <!-- Player Profile & Cricket Information -->
            <div>
                <h3 class="text-lg font-bold text-ink mb-4 pb-1 border-b border-ink/10">ক্রিকেট প্রোফাইল তথ্য</h3>

                <div class="space-y-5">
                    <!-- Batting Style -->
                    <div>
                        <label class="block text-sm font-semibold text-ink/80 mb-2">ব্যাটিং স্টাইল</label>
                        <div class="flex gap-6 items-center">
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="batting_style" value="right_hand" required
                                    class="w-4 h-4 accent-pitch">
                                <span class="text-sm font-medium">ডানহাতি (Right Hand)</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="batting_style" value="left_hand"
                                    class="w-4 h-4 accent-pitch">
                                <span class="text-sm font-medium">বাঁহাতি (Left Hand)</span>
                            </label>
                        </div>
                    </div>

                    <!-- Primary Role -->
                    <div>
                        <label class="block text-sm font-semibold text-ink/80 mb-2">প্লেয়ার টাইপ (মূল ভূমিকা)</label>
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                            <label
                                class="border border-ink/15 p-3 rounded-xl flex items-center justify-center gap-2 cursor-pointer bg-white hover:border-gold transition">
                                <input type="radio" name="player_role" value="batsman" required class="accent-pitch">
                                <span class="text-sm font-semibold">ব্যাটার</span>
                            </label>
                            <label
                                class="border border-ink/15 p-3 rounded-xl flex items-center justify-center gap-2 cursor-pointer bg-white hover:border-gold transition">
                                <input type="radio" name="player_role" value="bowler" class="accent-pitch">
                                <span class="text-sm font-semibold">বোলার</span>
                            </label>
                            <label
                                class="border border-ink/15 p-3 rounded-xl flex items-center justify-center gap-2 cursor-pointer bg-white hover:border-gold transition">
                                <input type="radio" name="player_role" value="all_rounder" class="accent-pitch">
                                <span class="text-sm font-semibold">অলরাউন্ডার</span>
                            </label>
                            <label
                                class="border border-ink/15 p-3 rounded-xl flex items-center justify-center gap-2 cursor-pointer bg-white hover:border-gold transition">
                                <input type="radio" name="player_role" value="wicket_keeper" class="accent-pitch">
                                <span class="text-sm font-semibold">উইকেটরক্ষক</span>
                            </label>
                        </div>
                    </div>

                    <!-- Bowling Style & Jersey Size -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 pt-2">
                        <div>
                            <label class="block text-sm font-semibold text-ink/80 mb-1.5">অন্যান্য দক্ষতা / বোলিং
                                ধরণ</label>
                            <input type="text" placeholder="যেমন: রাইট-আর্ম ফাস্ট / অফ স্পিন"
                                class="w-full rounded-xl border border-ink/15 px-4 py-3 bg-white focus:border-gold outline-none transition">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-ink/80 mb-1.5">জার্সি সাইজ (Jersey
                                Size)</label>
                            <select required
                                class="w-full rounded-xl border border-ink/15 px-4 py-3 bg-white focus:border-gold outline-none transition">
                                <option value="" disabled selected>সাইজ নির্বাচন করুন</option>
                                <option value="M">Medium (M)</option>
                                <option value="L">Large (L)</option>
                                <option value="XL">Extra Large (XL)</option>
                                <option value="XXL">Double Extra Large (XXL)</option>
                            </select>
                        </div>
                    </div>

                    <!-- Past Team & Auction Info -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                        <div>
                            <label class="block text-sm font-semibold text-ink/80 mb-1.5">পূর্বের টিম (যদি
                                থাকে)</label>
                            <input type="text" placeholder="পূর্বের দলের নাম"
                                class="w-full rounded-xl border border-ink/15 px-4 py-3 bg-white focus:border-gold outline-none transition">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-ink/80 mb-1.5">গ্রেড (Grade)</label>
                            <select required
                                class="w-full rounded-xl border border-ink/15 px-4 py-3 bg-white focus:border-gold outline-none transition">
                                <option value="" disabled selected>গ্রেড সিলেক্ট করুন</option>
                                <option value="A">Grade A</option>
                                <option value="B">Grade B</option>
                                <option value="C">Grade C</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-ink/80 mb-1.5">নিলাম মূল্য / বেস
                                প্রাইজ</label>
                            <input type="number" placeholder="যেমন: ৫০০০"
                                class="w-full rounded-xl border border-ink/15 px-4 py-3 bg-white focus:border-gold outline-none transition">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment Proof Section -->
            <div class="bg-white/80 p-5 rounded-2xl border border-ink/10 space-y-4">
                <h3 class="text-lg font-bold text-ink border-b border-ink/10 pb-2 flex items-center justify-between">
                    <span>রেজিস্ট্রেশন ফি প্রদান</span>
                    <span class="text-sm font-bold bg-pitch/10 text-pitch px-3 py-1 rounded-full">১০০ টাকা</span>
                </h3>

                <!-- Instructions Box -->
                <div
                    class="bg-amber-50 border border-amber-200 text-amber-900 rounded-xl p-3.5 text-xs sm:text-sm leading-relaxed">
                    নিচের যেকোনো একটি নম্বরে <strong>১০০ টাকা Send Money</strong> করুন এবং পেমেন্ট সম্পন্ন হলে প্রদত্ত
                    তথ্যগুলো নিচে পূরণ করুন:
                    <div class="mt-2 font-mono font-bold flex flex-wrap gap-4 text-ink">
                        <span>bKash: 01XXXXXXXXX</span>
                        <span>Nagad: 01XXXXXXXXX</span>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-ink/80 mb-1.5">পেমেন্ট মেথড</label>
                        <select required
                            class="w-full rounded-xl border border-ink/15 px-4 py-2.5 bg-white focus:border-gold outline-none transition">
                            <option value="" disabled selected>মেথড নির্বাচন করুন</option>
                            <option value="bkash">bKash</option>
                            <option value="nagad">Nagad</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-ink/80 mb-1.5">যে নম্বর থেকে টাকা
                            পাঠিয়েছেন</label>
                        <input required type="tel" placeholder="01XXXXXXXXX"
                            class="w-full rounded-xl border border-ink/15 px-4 py-2.5 bg-white focus:border-gold outline-none transition">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-ink/80 mb-1.5">ট্রানজেকশন আইডি (TrxID)</label>
                        <input required type="text" placeholder="যেমন: 8N7A6D5C"
                            class="w-full rounded-xl border border-ink/15 px-4 py-2.5 bg-white focus:border-gold outline-none font-mono uppercase transition">
                    </div>
                </div>
            </div>

            <!-- Checkbox Terms -->
            <div class="flex items-center gap-3 pt-2">
                <input required type="checkbox" id="terms"
                    class="w-5 h-5 accent-pitch rounded border-ink/15 cursor-pointer">
                <label for="terms" class="text-sm text-ink/70 cursor-pointer">
                    আমি নিশ্চিত করছি যে ১০০ টাকা ফি প্রদান করেছি এবং প্রদত্ত সকল তথ্য সঠিক।
                </label>
            </div>

            <!-- Submit Button -->
            <button type="submit"
                class="w-full mt-6 px-6 py-4 rounded-full bg-pitch text-cream font-bold hover:bg-pitchdark transition shadow-lg text-lg">
                প্লেয়ার নিবন্ধন সম্পন্ন করুন
            </button>
        </form>
    </div>
</section>
