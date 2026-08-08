  <!-- ============ HEADER / NAV ============ -->
  <header class="sticky top-0 z-40 bg-pitchdark/95 backdrop-blur border-b border-gold/20">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 flex items-center justify-between h-16">
          <a href="#home" class="flex items-center gap-2.5 shrink-0">
              <span
                  class="w-10 h-10 rounded-full bg-gold flex items-center justify-center text-pitchdark text-xl font-display font-800">🏏</span>
              <span class="leading-tight">
                  <span class="block font-display font-700 text-cream text-lg -mb-1">একতা যুব সংঘ</span>
                  <span class="block font-display font-800 text-gold text-sm tracking-widest">MPL</span>
              </span>
          </a>

          <nav class="hidden lg:flex items-center gap-5 text-cream/90 text-[15px] font-medium">
              <a href="#home" class="hover:text-gold transition">হোম</a>
              <a href="#teams" class="hover:text-gold transition">দলসমূহ</a>
              <a href="#playersPreview" class="hover:text-gold transition">খেলোয়াড়</a>
              <a href="#matches" class="hover:text-gold transition">ম্যাচ</a>
              <a href="#scoreboard" class="hover:text-gold transition">স্কোরবোর্ড</a>
              <a href="#points" class="hover:text-gold transition">পয়েন্ট টেবিল</a>
              <a href="#fixtures" class="hover:text-gold transition">ফিক্সচার</a>
              <a href="#tournaments" class="hover:text-gold transition">টুর্নামেন্ট</a>
              <a href="#committee" class="hover:text-gold transition">কমিটি</a>
          </nav>

          <div class="hidden lg:flex items-center gap-3">
              <button onclick="openModal('teamModal')"
                  class="px-4 py-2 rounded-full text-sm font-semibold bg-transparent border border-gold text-gold hover:bg-gold hover:text-pitchdark transition">দল
                  নিবন্ধন</button>
              <button onclick="openModal('playerModal')"
                  class="px-4 py-2 rounded-full text-sm font-semibold bg-gold text-pitchdark hover:bg-goldlight transition">খেলোয়াড়
                  নিবন্ধন</button>
          </div>

          <button id="menuBtn" onclick="toggleMenu()" class="lg:hidden text-cream text-2xl"
              aria-label="মেনু খুলুন">☰</button>
      </div>

      <!-- mobile menu -->
      <div id="mobileMenu" class="hidden lg:hidden bg-pitchdark border-t border-gold/20 px-4 pb-4">
          <nav class="flex flex-col gap-3 pt-3 text-cream/90 text-[15px] font-medium">
              <a href="#home" onclick="toggleMenu()" class="hover:text-gold">হোম</a>
              <a href="#teams" onclick="toggleMenu()" class="hover:text-gold">দলসমূহ</a>
              <a href="#playersPreview" onclick="toggleMenu()" class="hover:text-gold">খেলোয়াড়</a>
              <a href="#matches" onclick="toggleMenu()" class="hover:text-gold">ম্যাচ</a>
              <a href="#scoreboard" onclick="toggleMenu()" class="hover:text-gold">স্কোরবোর্ড</a>
              <a href="#points" onclick="toggleMenu()" class="hover:text-gold">পয়েন্ট টেবিল</a>
              <a href="#fixtures" onclick="toggleMenu()" class="hover:text-gold">ফিক্সচার</a>
              <a href="#tournaments" onclick="toggleMenu()" class="hover:text-gold">টুর্নামেন্ট</a>
              <a href="#committee" onclick="toggleMenu()" class="hover:text-gold">কমিটি</a>
              <div class="flex gap-2 pt-2">
                  <button onclick="openModal('teamModal')"
                      class="flex-1 px-4 py-2 rounded-full text-sm font-semibold border border-gold text-gold">দল
                      নিবন্ধন</button>
                  <button onclick="openModal('playerModal')"
                      class="flex-1 px-4 py-2 rounded-full text-sm font-semibold bg-gold text-pitchdark">খেলোয়াড়
                      নিবন্ধন</button>
              </div>
          </nav>
      </div>
  </header>
