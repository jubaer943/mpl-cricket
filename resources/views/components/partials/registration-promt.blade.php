<div class="seam seam-maroon"></div>
<section class="bg-creamdark py-14">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 grid sm:grid-cols-2 gap-6">
        <div class="bg-cream rounded-3xl p-8 border border-ink/10 shadow-sm flex flex-col">
            <span class="text-4xl mb-3">🛡️</span>
            <h3 class="font-display font-700 text-2xl mb-2">দল নিবন্ধন</h3>
            <p class="text-ink/70 mb-6 flex-1">আপনার এলাকার দল নিয়ে MPL ২০২৬-এ অংশ নিন। দলের নাম, অধিনায়কের তথ্য
                দিয়ে
                সহজেই নিবন্ধন করুন।</p>
            <a href="{{ route('team.register')}}"
                class="self-start px-6 py-2.5 rounded-full bg-pitch text-cream font-semibold hover:bg-pitchdark transition">দল
                নিবন্ধন করুন →</a>
        </div>
        <div class="bg-cream rounded-3xl p-8 border border-ink/10 shadow-sm flex flex-col">
            <span class="text-4xl mb-3">🏏</span>
            <h3 class="font-display font-700 text-2xl mb-2">খেলোয়াড় নিবন্ধন</h3>
            <p class="text-ink/70 mb-6 flex-1">একক খেলোয়াড় হিসেবে নিবন্ধন করুন এবং দলের নিলামে অংশ নেওয়ার সুযোগ
                পান।
            </p>
            <a href="{{ route('player.register')}}"
                class="self-start px-6 py-2.5 rounded-full bg-maroon text-cream font-semibold hover:bg-maroon/90 transition">খেলোয়াড়
                নিবন্ধন করুন →</a>
        </div>
    </div>
</section>