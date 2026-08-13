 <div class="seam seam-maroon"></div>

 <!-- ============ TOURNAMENT ARCHIVE ============ -->
 <section id="tournaments" class="max-w-7xl mx-auto px-4 sm:px-6 py-16">
     <div class="text-center mb-10">
         <p class="text-maroon font-semibold tracking-widest text-xs">আর্কাইভ</p>
         <h2 class="font-display font-700 text-3xl sm:text-4xl mt-1">টুর্নামেন্ট তালিকা</h2>
         <p class="text-ink/50 text-sm mt-2">টুর্নামেন্টে ক্লিক করলে সেই মৌসুমের সম্পূর্ণ ফিক্সচার ও ফলাফল দেখা যাবে
         </p>
     </div>

     <div id="tournamentGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
         @forelse($tournaments as $tournament)
             <div onclick="go('tournament', '{{ $tournament->slug ?? $tournament->id }}')"
                 class="rounded-2xl border-2 border-gold bg-cream p-5 hover:-translate-y-1 transition-all duration-300 cursor-pointer shadow-sm hover:shadow-md flex flex-col justify-between">

                 <div>
                     {{-- টুর্নামেন্ট স্ট্যাটাস --}}
                     <div class="flex items-center justify-between mb-3">
                         <span
                             class="inline-block text-xs font-semibold text-maroon bg-maroon/10 px-2.5 py-0.5 rounded-full capitalize">
                             {{ $tournament->status ?? 'চলমান' }}
                         </span>
                     </div>

                     {{-- টুর্নামেন্টের নাম --}}
                     <h3 class="font-display font-bold text-xl text-ink mb-2">
                         {{ $tournament->name }}
                     </h3>

                     {{-- দল ও ম্যাচের সংখ্যা --}}
                     <p class="text-ink/70 text-sm mb-1">
                         {{ $tournament->teams_count }}টি দল · {{ $tournament->total_matches ?? 0 }} ম্যাচ
                     </p>

                     {{-- চ্যাম্পিয়ন তথ্য --}}
                     <p class="text-ink/70 text-sm">
                         চ্যাম্পিয়ন: <span
                             class="font-medium text-ink">{{ $tournament->champion_name ?? 'নির্ধারিত হয়নি' }}</span>
                     </p>
                 </div>

                 {{-- অ্যাকশন লিংক --}}
                 <div class="pt-4 mt-2 border-t border-gold/20">
                     <p class="text-maroon text-xs font-semibold flex items-center justify-between">
                         <span>ফিক্সচার ও ফলাফল দেখুন</span>
                         <span>→</span>
                     </p>
                 </div>
             </div>
         @empty
             <div class="col-span-full text-center py-10">
                 <p class="text-ink/60">কোনো টুর্নামেন্ট পাওয়া যায়নি।</p>
             </div>
         @endforelse
     </div>
 </section>
