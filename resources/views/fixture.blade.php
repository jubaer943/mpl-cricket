<x-layouts.master>
    <div id="page-tournament" class="page bg-creamdark min-h-screen py-10">
        <div class="max-w-5xl mx-auto px-4 sm:px-6">
            <button onclick="go('home')" class="text-sm text-pitch font-semibold hover:underline mb-4">← হোমে
                ফিরুন</button>

            <!-- হেডার -->
            <div id="tournamentHeader" class="mb-8">
                <span
                    class="inline-block text-xs font-semibold text-maroon bg-maroon/10 px-2.5 py-0.5 rounded-full mb-3">চলমান</span>
                <h2 class="font-display font-800 text-3xl sm:text-4xl">মজমপুর প্রিমিয়ার ক্রিকেট লীগ-২০২৬</h2>
                <p class="text-ink/60 mt-2">৬টি দল অংশগ্রহণ করেছে · মোট ১৫টি ম্যাচ</p>
                <p class="text-ink/60">চ্যাম্পিয়ন: <span class="font-semibold text-maroon">নির্ধারিত হয়নি</span></p>
            </div>

            <div id="tournamentFixturesWrap">
                <!-- লীগ পর্ব -->
                <div class="mb-8">
                    <h3 class="font-display font-600 text-lg text-pitch mb-3">লীগ পর্ব</h3>
                    <div class="bg-cream rounded-2xl divide-y divide-ink/10 border border-ink/10 overflow-hidden">

                        <!-- ১ম সপ্তাহ -->
                        <div class="bg-ink/5 px-5 py-2 text-xs font-bold text-ink/70 uppercase">১ম সপ্তাহ — ০২ অক্টোবর,
                            শুক্রবার</div>
                        <div class="flex flex-wrap items-center gap-2 justify-between px-5 py-3 text-sm cursor-pointer hover:bg-goldlight/20"
                            onclick="go('scorecard','m1')">
                            <span class="text-ink/50 w-32">সকাল ১ম ম্যাচ</span>
                            <span class="font-medium">নুরবাগ-৫৩ বনাম মনজুরুল হক চৌধুরী রতন একাদশ</span>
                            <span class="text-ink/50">উপজেলা স্টেডিয়াম</span>
                        </div>
                        <div class="flex flex-wrap items-center gap-2 justify-between px-5 py-3 text-sm cursor-pointer hover:bg-goldlight/20"
                            onclick="go('scorecard','m2')">
                            <span class="text-ink/50 w-32">সকাল ২য় ম্যাচ</span>
                            <span class="font-medium">বিডিএম রাইডার্স বনাম মজমপুর হান্টার্স</span>
                            <span class="text-ink/50">উপজেলা স্টেডিয়াম</span>
                        </div>
                        <div class="flex flex-wrap items-center gap-2 justify-between px-5 py-3 text-sm cursor-pointer hover:bg-goldlight/20"
                            onclick="go('scorecard','m3')">
                            <span class="text-ink/50 w-32">বিকাল ম্যাচ</span>
                            <span class="font-medium">সকাল সন্ধ্যা এক্সপ্রেস বনাম জয়নাল স্মৃতি একাদশ</span>
                            <span class="text-ink/50">উপজেলা স্টেডিয়াম</span>
                        </div>

                        <!-- ২য় সপ্তাহ -->
                        <div class="bg-ink/5 px-5 py-2 text-xs font-bold text-ink/70 uppercase">২য় সপ্তাহ — ০৯ অক্টোবর,
                            শুক্রবার</div>
                        <div class="flex flex-wrap items-center gap-2 justify-between px-5 py-3 text-sm cursor-pointer hover:bg-goldlight/20"
                            onclick="go('scorecard','m4')">
                            <span class="text-ink/50 w-32">সকাল ১ম ম্যাচ</span>
                            <span class="font-medium">নুরবাগ-৫৩ বনাম মজমপুর হান্টার্স</span>
                            <span class="text-ink/50">উপজেলা স্টেডিয়াম</span>
                        </div>
                        <div class="flex flex-wrap items-center gap-2 justify-between px-5 py-3 text-sm cursor-pointer hover:bg-goldlight/20"
                            onclick="go('scorecard','m5')">
                            <span class="text-ink/50 w-32">সকাল ২য় ম্যাচ</span>
                            <span class="font-medium">মনজুরুল হক চৌধুরী রতন একাদশ বনাম জয়নাল স্মৃতি একাদশ</span>
                            <span class="text-ink/50">উপজেলা স্টেডিয়াম</span>
                        </div>
                        <div class="flex flex-wrap items-center gap-2 justify-between px-5 py-3 text-sm cursor-pointer hover:bg-goldlight/20"
                            onclick="go('scorecard','m6')">
                            <span class="text-ink/50 w-32">বিকাল ম্যাচ</span>
                            <span class="font-medium">বিডিএম রাইডার্স বনাম সকাল সন্ধ্যা এক্সপ্রেস</span>
                            <span class="text-ink/50">উপজেলা স্টেডিয়াম</span>
                        </div>

                        <!-- ৩য় সপ্তাহ -->
                        <div class="bg-ink/5 px-5 py-2 text-xs font-bold text-ink/70 uppercase">৩য় সপ্তাহ — ১৬ অক্টোবর,
                            শুক্রবার</div>
                        <div class="flex flex-wrap items-center gap-2 justify-between px-5 py-3 text-sm cursor-pointer hover:bg-goldlight/20"
                            onclick="go('scorecard','m7')">
                            <span class="text-ink/50 w-32">সকাল ১ম ম্যাচ</span>
                            <span class="font-medium">নুরবাগ-৫৩ বনাম জয়নাল স্মৃতি একাদশ</span>
                            <span class="text-ink/50">উপজেলা স্টেডিয়াম</span>
                        </div>
                        <div class="flex flex-wrap items-center gap-2 justify-between px-5 py-3 text-sm cursor-pointer hover:bg-goldlight/20"
                            onclick="go('scorecard','m8')">
                            <span class="text-ink/50 w-32">সকাল ২য় ম্যাচ</span>
                            <span class="font-medium">মজমপুর হান্টার্স বনাম সকাল সন্ধ্যা এক্সপ্রেস</span>
                            <span class="text-ink/50">উপজেলা স্টেডিয়াম</span>
                        </div>
                        <div class="flex flex-wrap items-center gap-2 justify-between px-5 py-3 text-sm cursor-pointer hover:bg-goldlight/20"
                            onclick="go('scorecard','m9')">
                            <span class="text-ink/50 w-32">বিকাল ম্যাচ</span>
                            <span class="font-medium">মনজুরুল হক চৌধুরী রতন একাদশ বনাম বিডিএম রাইডার্স</span>
                            <span class="text-ink/50">উপজেলা স্টেডিয়াম</span>
                        </div>

                        <!-- ৪থ সপ্তাহ -->
                        <div class="bg-ink/5 px-5 py-2 text-xs font-bold text-ink/70 uppercase">৪র্থ সপ্তাহ — ২৩
                            অক্টোবর,
                            শুক্রবার</div>
                        <div class="flex flex-wrap items-center gap-2 justify-between px-5 py-3 text-sm cursor-pointer hover:bg-goldlight/20"
                            onclick="go('scorecard','m10')">
                            <span class="text-ink/50 w-32">সকাল ১ম ম্যাচ</span>
                            <span class="font-medium">নুরবাগ-৫৩ বনাম সকাল সন্ধ্যা এক্সপ্রেস</span>
                            <span class="text-ink/50">উপজেলা স্টেডিয়াম</span>
                        </div>
                        <div class="flex flex-wrap items-center gap-2 justify-between px-5 py-3 text-sm cursor-pointer hover:bg-goldlight/20"
                            onclick="go('scorecard','m11')">
                            <span class="text-ink/50 w-32">সকাল ২য় ম্যাচ</span>
                            <span class="font-medium">জয়নাল স্মৃতি একাদশ বনাম বিডিএম রাইডার্স</span>
                            <span class="text-ink/50">উপজেলা স্টেডিয়াম</span>
                        </div>
                        <div class="flex flex-wrap items-center gap-2 justify-between px-5 py-3 text-sm cursor-pointer hover:bg-goldlight/20"
                            onclick="go('scorecard','m12')">
                            <span class="text-ink/50 w-32">বিকাল ম্যাচ</span>
                            <span class="font-medium">মজমপুর হান্টার্স বনাম মনজুরুল হক চৌধুরী রতন একাদশ</span>
                            <span class="text-ink/50">উপজেলা স্টেডিয়াম</span>
                        </div>

                        <!-- ৫মে সপ্তাহ -->
                        <div class="bg-ink/5 px-5 py-2 text-xs font-bold text-ink/70 uppercase">৫ম সপ্তাহ — ৩০ অক্টোবর,
                            শুক্রবার</div>
                        <div class="flex flex-wrap items-center gap-2 justify-between px-5 py-3 text-sm cursor-pointer hover:bg-goldlight/20"
                            onclick="go('scorecard','m13')">
                            <span class="text-ink/50 w-32">সকাল ১ম ম্যাচ</span>
                            <span class="font-medium">নুরবাগ-৫৩ বনাম বিডিএম রাইডার্স</span>
                            <span class="text-ink/50">উপজেলা স্টেডিয়াম</span>
                        </div>
                        <div class="flex flex-wrap items-center gap-2 justify-between px-5 py-3 text-sm cursor-pointer hover:bg-goldlight/20"
                            onclick="go('scorecard','m14')">
                            <span class="text-ink/50 w-32">সকাল ২য় ম্যাচ</span>
                            <span class="font-medium">সকাল সন্ধ্যা এক্সপ্রেস বনাম মনজুরুল হক চৌধুরী রতন একাদশ</span>
                            <span class="text-ink/50">উপজেলা স্টেডিয়াম</span>
                        </div>
                        <div class="flex flex-wrap items-center gap-2 justify-between px-5 py-3 text-sm cursor-pointer hover:bg-goldlight/20"
                            onclick="go('scorecard','m15')">
                            <span class="text-ink/50 w-32">বিকাল ম্যাচ</span>
                            <span class="font-medium">জয়নাল স্মৃতি একাদশ বনাম মজমপুর হান্টার্স</span>
                            <span class="text-ink/50">উপজেলা স্টেডিয়াম</span>
                        </div>

                    </div>
                </div>

                <!-- সেমিফাইনাল -->
                <div class="mb-8">
                    <h3 class="font-display font-600 text-lg text-pitch mb-3">সেমিফাইনাল — ০৬ নভেম্বর, শুক্রবার</h3>
                    <div class="bg-cream rounded-2xl divide-y divide-ink/10 border border-ink/10 overflow-hidden">
                        <div class="flex flex-wrap items-center gap-2 justify-between px-5 py-3 text-sm">
                            <span class="text-ink/50 w-32">সেমিফাইনাল-১</span>
                            <span class="font-medium">লিগে ১ম স্থান বনাম লিগে ২য় স্থান</span>
                            <span class="text-ink/50">উপজেলা স্টেডিয়াম</span>
                        </div>
                        <div class="flex flex-wrap items-center gap-2 justify-between px-5 py-3 text-sm">
                            <span class="text-ink/50 w-32">সেমিফাইনাল-২</span>
                            <span class="font-medium">লিগে ৩য় স্থান বনাম লিগে ৪র্থ স্থান</span>
                            <span class="text-ink/50">উপজেলা স্টেডিয়াম</span>
                        </div>
                    </div>
                </div>

                <!-- এলিমিনেটর -->
                <div class="mb-8">
                    <h3 class="font-display font-600 text-lg text-pitch mb-3">এলিমিনেটর</h3>
                    <div class="bg-cream rounded-2xl divide-y divide-ink/10 border border-ink/10 overflow-hidden">
                        <div class="flex flex-wrap items-center gap-2 justify-between px-5 py-3 text-sm">
                            <span class="text-ink/50 w-32">এলিমিনেটর</span>
                            <span class="font-medium">সেমিফাইনাল-১ এর পরাজিত দল বনাম সেমিফাইনাল-২ এর বিজয়ী দল</span>
                            <span class="text-ink/50">উপজেলা স্টেডিয়াম</span>
                        </div>
                    </div>
                </div>

                <!-- ফাইনাল -->
                <div class="mb-8">
                    <h3 class="font-display font-600 text-lg text-maroon mb-3">ফাইনাল — ১৩ নভেম্বর, শুক্রবার</h3>
                    <div>
                        <div
                            class="bg-pitchdark rounded-2xl px-5 py-4 text-cream flex flex-wrap items-center gap-2 justify-between text-sm border border-gold/30">
                            <span class="text-cream/60 w-32">ফাইনাল</span>
                            <span class="font-display font-600 text-gold">সেমিফাইনাল-১ এর বিজয়ী দল বনাম এলিমিনেটরের
                                বিজয়ী
                                দল</span>
                            <span class="text-cream/60">উপজেলা স্টেডিয়াম</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-layouts.master>