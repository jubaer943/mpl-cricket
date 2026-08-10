<section class="py-12 px-4 sm:px-6 lg:px-8 bg-cream/50 min-h-screen">
    <div class="bg-cream rounded-3xl w-full max-w-3xl mx-auto border border-ink/10 p-6 sm:p-10 shadow-lg">

        <!-- Form Header -->
        <div class="mb-8 text-center">
            <h2 class="font-display font-bold text-3xl sm:text-4xl text-ink mb-2">খেলোয়াড় নিবন্ধন ফর্ম</h2>
            <p class="text-ink/60 text-base">টুর্নামেন্টে অংশগ্রহণের জন্য প্লেয়ারের সঠিক তথ্য ও ফি প্রদান করুন।</p>
        </div>

        <!-- Registration Form -->
        <div class="max-w-4xl mx-auto p-6 bg-white rounded-2xl shadow-md">

            <!-- Success Message -->
            @if (session('success'))
                <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-xl">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Validation Error Alert -->
            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-600 rounded-xl">
                    <p class="font-bold mb-2">অনুগ্রহ করে নিচের ভুলগুলো সংশোধন করুন:</p>
                    <ul class="list-disc pl-5 text-sm space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('player.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Personal Info Section -->
                <div>
                    <h3 class="text-lg font-bold text-ink mb-4 pb-1 border-b border-ink/10">ব্যক্তিগত তথ্য ও ছবি</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <!-- Player Photo -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-ink/80 mb-1.5">প্লেয়ারের ছবি (Passport Size
                                Photo) <span class="text-red-500">*</span></label>
                            <input type="file" name="photo" accept="image/*"
                                class="w-full rounded-xl border border-ink/15 px-4 py-2.5 bg-white text-sm file:mr-4 file:py-1.5 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-pitch file:text-cream hover:file:bg-pitchdark transition cursor-pointer">
                            @error('photo')
                                <span class="text-xs text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-ink/80 mb-1.5">প্লেয়ারের নাম <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="name" value="{{ old('name') }}"
                                placeholder="পূর্ণ নাম লিখুন"
                                class="w-full rounded-xl border border-ink/15 px-4 py-3 bg-white focus:border-gold outline-none transition">
                            @error('name')
                                <span class="text-xs text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-ink/80 mb-1.5">পিতার নাম <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="father_name" value="{{ old('father_name') }}"
                                placeholder="পিতার নাম"
                                class="w-full rounded-xl border border-ink/15 px-4 py-3 bg-white focus:border-gold outline-none transition">
                            @error('father_name')
                                <span class="text-xs text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-ink/80 mb-1.5">মাতার নাম <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="mother_name" value="{{ old('mother_name') }}"
                                placeholder="মাতার নাম"
                                class="w-full rounded-xl border border-ink/15 px-4 py-3 bg-white focus:border-gold outline-none transition">
                            @error('mother_name')
                                <span class="text-xs text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-ink/80 mb-1.5">মোবাইল নম্বর <span
                                    class="text-red-500">*</span></label>
                            <input type="tel" name="phone" value="{{ old('phone') }}" placeholder="01XXXXXXXXX"
                                class="w-full rounded-xl border border-ink/15 px-4 py-3 bg-white focus:border-gold outline-none transition">
                            @error('phone')
                                <span class="text-xs text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-ink/80 mb-1.5">জন্ম তারিখ <span
                                    class="text-red-500">*</span></label>
                            <input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}"
                                class="w-full rounded-xl border border-ink/15 px-4 py-3 bg-white focus:border-gold outline-none transition text-ink/80">
                            @error('date_of_birth')
                                <span class="text-xs text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-ink/80 mb-1.5">জাতীয়তা</label>
                            <input type="text" name="nationality" value="{{ old('nationality', 'বাংলাদেশী') }}"
                                class="w-full rounded-xl border border-ink/15 px-4 py-3 bg-white focus:border-gold outline-none transition">
                        </div>
                    </div>
                </div>

                <!-- Address Section -->
                <div>
                    <h3 class="text-lg font-bold text-ink mb-4 pb-1 border-b border-ink/10">ঠিকানা</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-semibold text-ink/80 mb-1.5">গ্রাম <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="village" value="{{ old('village') }}" placeholder="গ্রামের নাম"
                                class="w-full rounded-xl border border-ink/15 px-4 py-3 bg-white focus:border-gold outline-none transition">
                            @error('village')
                                <span class="text-xs text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-ink/80 mb-1.5">ডাকঘর <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="post_office" value="{{ old('post_office') }}"
                                placeholder="ডাকঘর"
                                class="w-full rounded-xl border border-ink/15 px-4 py-3 bg-white focus:border-gold outline-none transition">
                            @error('post_office')
                                <span class="text-xs text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-ink/80 mb-1.5">থানা <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="thana" value="{{ old('thana') }}" placeholder="থানার নাম"
                                class="w-full rounded-xl border border-ink/15 px-4 py-3 bg-white focus:border-gold outline-none transition">
                            @error('thana')
                                <span class="text-xs text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-ink/80 mb-1.5">জেলা <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="district" value="{{ old('district') }}"
                                placeholder="জেলার নাম"
                                class="w-full rounded-xl border border-ink/15 px-4 py-3 bg-white focus:border-gold outline-none transition">
                            @error('district')
                                <span class="text-xs text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Added Other Address Field with Note -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-ink/80 mb-1">অন্যান্য (বসবাসরত
                                ঠিকানা)</label>
                            <input type="text" name="other_address" value="{{ old('other_address') }}"
                                placeholder="অন্যান্য ঠিকানা বিবরণ"
                                class="w-full rounded-xl border border-ink/15 px-4 py-3 bg-white focus:border-gold outline-none transition">
                            <p class="mt-1.5 text-xs text-amber-700 font-medium">
                                * বসবাসরত ঠিকানা (১৮ ওয়ার্ড এর মধ্যে হতে হবে এবং পূর্বের নিয়মিত অংশগ্রহণকারী খেলোয়াড়
                                ও আলোচনা সাপেক্ষ)
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Player Profile & Cricket Information -->
                <div>
                    <h3 class="text-lg font-bold text-ink mb-4 pb-1 border-b border-ink/10">ক্রিকেট প্রোফাইল তথ্য</h3>

                    <div class="space-y-5">
                        <!-- Batting Style -->
                        <div>
                            <label class="block text-sm font-semibold text-ink/80 mb-2">ব্যাটিং স্টাইল <span
                                    class="text-red-500">*</span></label>
                            <div class="flex gap-6 items-center">
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" name="batting_style" value="right_hand"
                                        {{ old('batting_style') == 'right_hand' ? 'checked' : '' }}
                                        class="w-4 h-4 accent-pitch">
                                    <span class="text-sm font-medium">ডানহাতি (Right Hand)</span>
                                </label>
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" name="batting_style" value="left_hand"
                                        {{ old('batting_style') == 'left_hand' ? 'checked' : '' }}
                                        class="w-4 h-4 accent-pitch">
                                    <span class="text-sm font-medium">বাঁহাতি (Left Hand)</span>
                                </label>
                            </div>
                            @error('batting_style')
                                <span class="text-xs text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Primary Role -->
                        <div>
                            <label class="block text-sm font-semibold text-ink/80 mb-2">প্লেয়ার টাইপ (মূল ভূমিকা)
                                <span class="text-red-500">*</span></label>
                            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                                <label
                                    class="border border-ink/15 p-3 rounded-xl flex items-center justify-center gap-2 cursor-pointer bg-white hover:border-gold transition">
                                    <input type="radio" name="player_role" value="batsman"
                                        {{ old('player_role') == 'batsman' ? 'checked' : '' }} class="accent-pitch">
                                    <span class="text-sm font-semibold">ব্যাটার</span>
                                </label>
                                <label
                                    class="border border-ink/15 p-3 rounded-xl flex items-center justify-center gap-2 cursor-pointer bg-white hover:border-gold transition">
                                    <input type="radio" name="player_role" value="bowler"
                                        {{ old('player_role') == 'bowler' ? 'checked' : '' }} class="accent-pitch">
                                    <span class="text-sm font-semibold">বোলার</span>
                                </label>
                                <label
                                    class="border border-ink/15 p-3 rounded-xl flex items-center justify-center gap-2 cursor-pointer bg-white hover:border-gold transition">
                                    <input type="radio" name="player_role" value="all_rounder"
                                        {{ old('player_role') == 'all_rounder' ? 'checked' : '' }}
                                        class="accent-pitch">
                                    <span class="text-sm font-semibold">অলরাউন্ডার</span>
                                </label>
                                <label
                                    class="border border-ink/15 p-3 rounded-xl flex items-center justify-center gap-2 cursor-pointer bg-white hover:border-gold transition">
                                    <input type="radio" name="player_role" value="wicket_keeper"
                                        {{ old('player_role') == 'wicket_keeper' ? 'checked' : '' }}
                                        class="accent-pitch">
                                    <span class="text-sm font-semibold">উইকেটরক্ষক</span>
                                </label>
                            </div>
                            @error('player_role')
                                <span class="text-xs text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Bowling Style & Jersey Size -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 pt-2">
                            <div>
                                <label class="block text-sm font-semibold text-ink/80 mb-1.5">অন্যান্য দক্ষতা / বোলিং
                                    ধরণ</label>
                                <input type="text" name="bowling_style" value="{{ old('bowling_style') }}"
                                    placeholder="যেমন: রাইট-আর্ম ফাস্ট / অফ স্পিন"
                                    class="w-full rounded-xl border border-ink/15 px-4 py-3 bg-white focus:border-gold outline-none transition">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-ink/80 mb-1.5">জার্সি সাইজ (Jersey Size)
                                    <span class="text-red-500">*</span></label>
                                <select name="jersey_size"
                                    class="w-full rounded-xl border border-ink/15 px-4 py-3 bg-white focus:border-gold outline-none transition">
                                    <option value="" disabled selected>সাইজ নির্বাচন করুন</option>
                                    <option value="M" {{ old('jersey_size') == 'M' ? 'selected' : '' }}>Medium
                                        (M)</option>
                                    <option value="L" {{ old('jersey_size') == 'L' ? 'selected' : '' }}>Large (L)
                                    </option>
                                    <option value="XL" {{ old('jersey_size') == 'XL' ? 'selected' : '' }}>Extra
                                        Large (XL)</option>
                                    <option value="XXL" {{ old('jersey_size') == 'XXL' ? 'selected' : '' }}>Double
                                        Extra Large (XXL)</option>
                                </select>
                                @error('jersey_size')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Past Team & Auction Info -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                            <div>
                                <label class="block text-sm font-semibold text-ink/80 mb-1.5">পূর্বের টিম (যদি
                                    থাকে)</label>
                                <input type="text" name="past_team" value="{{ old('past_team') }}"
                                    placeholder="পূর্বের দলের নাম"
                                    class="w-full rounded-xl border border-ink/15 px-4 py-3 bg-white focus:border-gold outline-none transition">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-ink/80 mb-1.5">গ্রেড (Grade) </label>
                                <select name="grade"
                                    class="w-full rounded-xl border border-ink/15 px-4 py-3 bg-white focus:border-gold outline-none transition">
                                    <option value="" disabled selected>গ্রেড সিলেক্ট করুন</option>
                                    <option value="Grade A" {{ old('grade') == 'Grade A' ? 'selected' : '' }}>Grade A
                                    </option>
                                    <option value="Grade B" {{ old('grade') == 'Grade B' ? 'selected' : '' }}>Grade B
                                    </option>
                                    <option value="Grade C" {{ old('grade') == 'Grade C' ? 'selected' : '' }}>Grade C
                                    </option>
                                </select>
                                @error('grade')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-ink/80 mb-1.5">নিলাম মূল্য / বেস
                                    প্রাইজ</label>
                                <input type="number" name="base_price" value="{{ old('base_price') }}"
                                    placeholder="যেমন: ৫০০০"
                                    class="w-full rounded-xl border border-ink/15 px-4 py-3 bg-white focus:border-gold outline-none transition">
                            </div>
                        </div>

                        <!-- Added Optional Note Field -->
                        <div>
                            <label class="block text-sm font-semibold text-ink/80 mb-1.5">Note/Reference </label>
                            <textarea name="note" rows="2" placeholder="আপনার কোনো বিশেষ মন্তব্য থাকলে এখানে লিখতে পারেন..."
                                class="w-full rounded-xl border border-ink/15 px-4 py-2.5 bg-white focus:border-gold outline-none transition text-sm">{{ old('note') }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Payment Proof Section -->
                <div class="bg-white/80 p-5 rounded-2xl border border-ink/10 space-y-4">
                    <h3
                        class="text-lg font-bold text-ink border-b border-ink/10 pb-2 flex items-center justify-between">
                        <span>রেজিস্ট্রেশন ফি প্রদান</span>
                        <span class="text-sm font-bold bg-pitch/10 text-pitch px-3 py-1 rounded-full">১০০ টাকা</span>
                    </h3>

                    <!-- Instructions Box -->
                    <div
                        class="bg-amber-50 border border-amber-200 text-amber-900 rounded-xl p-3.5 text-xs sm:text-sm leading-relaxed">
                        নিচের যেকোনো একটি নম্বরে <strong>১০০ টাকা Send Money</strong> করুন এবং পেমেন্ট সম্পন্ন হলে
                        প্রদত্ত তথ্যগুলো নিচে পূরণ করুন:
                        <div class="mt-2 font-mono font-bold flex flex-wrap gap-4 text-ink">
                            <span>bKash: 01729377878</span>
                            <span>Nagad: 01729377878</span>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-ink/80 mb-1.5">পেমেন্ট মেথড <span
                                    class="text-red-500">*</span></label>
                            <select name="payment_method"
                                class="w-full rounded-xl border border-ink/15 px-4 py-2.5 bg-white focus:border-gold outline-none transition">
                                <option value="" disabled selected>মেথড নির্বাচন করুন</option>
                                <option value="bkash" {{ old('payment_method') == 'bkash' ? 'selected' : '' }}>bKash
                                </option>
                                <option value="nagad" {{ old('payment_method') == 'nagad' ? 'selected' : '' }}>Nagad
                                </option>
                            </select>
                            @error('payment_method')
                                <span class="text-xs text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-ink/80 mb-1.5">যে নম্বর থেকে টাকা পাঠিয়েছেন
                                <span class="text-red-500">*</span></label>
                            <input type="tel" name="sender_number" value="{{ old('sender_number') }}"
                                placeholder="01XXXXXXXXX"
                                class="w-full rounded-xl border border-ink/15 px-4 py-2.5 bg-white focus:border-gold outline-none transition">
                            @error('sender_number')
                                <span class="text-xs text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-ink/80 mb-1.5">ট্রানজেকশন আইডি (TrxID) <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="transaction_id" value="{{ old('transaction_id') }}"
                                placeholder="যেমন: 8N7A6D5C"
                                class="w-full rounded-xl border border-ink/15 px-4 py-2.5 bg-white focus:border-gold outline-none font-mono uppercase transition">
                            @error('transaction_id')
                                <span class="text-xs text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Checkbox Terms -->
                <div class="flex items-center gap-3 pt-2">
                    <input type="checkbox" name="terms" id="terms" value="1"
                        class="w-5 h-5 accent-pitch rounded border-ink/15 cursor-pointer">
                    <label for="terms" class="text-sm text-ink/70 cursor-pointer">
                        আমি নিশ্চিত করছি যে ১০০ টাকা ফি প্রদান করেছি এবং প্রদত্ত সকল তথ্য সঠিক। <span
                            class="text-red-500">*</span>
                    </label>
                </div>
                @error('terms')
                    <span class="text-xs text-red-500 block">{{ $message }}</span>
                @enderror

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full mt-6 px-6 py-4 rounded-full bg-pitch text-cream font-bold hover:bg-pitchdark transition shadow-lg text-lg">
                    প্লেয়ার নিবন্ধন সম্পন্ন করুন
                </button>
            </form>
        </div>
    </div>
</section>
