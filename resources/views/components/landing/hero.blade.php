@props(['data'])

@php
    $profil = $data['profil'] ?? null;
    $statistik = $data['statistik'] ?? [];
    $demografi = $statistik['demografi'] ?? [];
    $wilayah = $data['wilayah'] ?? null;

    $slides = [
        [
            'bg' => 'https://images.unsplash.com/photo-1541888946425-d0fbb186f5f8?auto=format&fit=crop&w=2000&q=80',
            'badge' => 'Portal Resmi Kelurahan Sukawarna &bull; Kota Bandung',
            'title' => 'Mewujudkan Sukawarna Asri, <br class="hidden sm:inline">Membangun <span class="whitespace-nowrap text-[#FFB703]">Masa Depan</span>',
            'desc' => $profil?->slogan ?? 'Di Kelurahan Sukawarna, kami menumbuhkan semangat kebersamaan warga melalui tata kelola digital terpadu, lingkungan lestari, dan pelayanan publik yang prima.',
            'primary_btn_text' => 'LAYANAN WARGA',
            'primary_btn_url' => route('layanan.index'),
            'secondary_btn_text' => 'JELAJAHI PETA WILAYAH',
            'secondary_btn_url' => route('peta.index'),
        ],
        [
            'bg' => 'https://images.unsplash.com/photo-1518495973542-4542c06a5843?auto=format&fit=crop&w=2000&q=80',
            'badge' => 'Inisiatif Lingkungan Lestari &bull; Buruan Sae Juara',
            'title' => 'Sukawarna Hijau Asri, <br class="hidden sm:inline">Mandiri <span class="whitespace-nowrap text-[#FFB703]">Berkelanjutan</span>',
            'desc' => 'Pemberdayaan lorong berkebun Buruan Sae, ketahanan pangan keluarga, pengelolaan bank sampah tematik, serta pemukiman ramah iklim berbasis gotong royong.',
            'primary_btn_text' => 'DIREKTORI FASILITAS',
            'primary_btn_url' => route('peta.index'),
            'secondary_btn_text' => 'UNDUH DOKUMEN & FORMULIR',
            'secondary_btn_url' => route('dokumen.index'),
        ],
        [
            'bg' => 'https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&w=2000&q=80',
            'badge' => 'Keterbukaan Publik & Satu Data Terpadu',
            'title' => 'Transparansi Nyata, <br class="hidden sm:inline">Melayani <span class="whitespace-nowrap text-[#FFB703]">Sepenuh Hati</span>',
            'desc' => 'Akses Satu Data terbuka, keterbukaan informasi publik (KIP) 100% digital, sistem pengaduan geo-civic ber-GPS, serta verifikasi surat instan via QR Code.',
            'primary_btn_text' => 'PORTAL SATU DATA',
            'primary_btn_url' => route('satu-data.index'),
            'secondary_btn_text' => 'LAYANAN PENGADUAN',
            'secondary_btn_url' => route('pengaduan.index'),
        ],
    ];
@endphp

<div class="relative bg-white" id="hero-carousel-container">
    <!-- Hero Banner with Background Image & Gradient Overlay -->
    <section class="relative min-h-[540px] sm:min-h-[580px] lg:min-h-[640px] flex items-center overflow-hidden bg-[#143527]">
        <!-- Background Slides with Smooth Opacity Crossfade -->
        @foreach($slides as $index => $slide)
            <div class="hero-bg-slide absolute inset-0 z-0 transition-opacity duration-1000 ease-in-out {{ $index === 0 ? 'opacity-100' : 'opacity-0 pointer-events-none' }}" data-slide="{{ $index }}">
                <img src="{{ $slide['bg'] }}" 
                     alt="Kelurahan Sukawarna Slide {{ $index + 1 }}" 
                     class="w-full h-full object-cover object-center filter brightness-[0.75] contrast-105">
                <!-- Deep Forest Green Gradient Overlay (Left to Right) -->
                <div class="absolute inset-0 bg-gradient-to-r from-[#143527]/95 via-[#1B4332]/85 to-transparent"></div>
                <!-- Bottom Fade for Seamless Floating Card Blend -->
                <div class="absolute inset-0 bg-gradient-to-t from-[#143527]/85 via-transparent to-black/20"></div>
            </div>
        @endforeach

        <!-- Slider Navigation Arrows (Desktop) -->
        <button type="button" 
                id="hero-prev-btn" 
                aria-label="Slide Sebelumnya" 
                class="hidden sm:flex absolute left-4 lg:left-8 top-1/2 -translate-y-1/2 z-20 w-11 h-11 rounded-full bg-black/30 hover:bg-black/60 border border-white/20 text-white items-center justify-center transition-all backdrop-blur-sm shadow-md cursor-pointer hover:scale-105 active:scale-95">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
        </button>
        <button type="button" 
                id="hero-next-btn" 
                aria-label="Slide Selanjutnya" 
                class="hidden sm:flex absolute right-4 lg:right-8 top-1/2 -translate-y-1/2 z-20 w-11 h-11 rounded-full bg-black/30 hover:bg-black/60 border border-white/20 text-white items-center justify-center transition-all backdrop-blur-sm shadow-md cursor-pointer hover:scale-105 active:scale-95">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
        </button>

        <!-- Hero Content Container -->
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 py-16 sm:py-20 lg:py-24 w-full pb-28 sm:pb-32 lg:pb-36">
            @foreach($slides as $index => $slide)
                <div class="hero-content-slide max-w-3xl space-y-5 sm:space-y-6 transition-all duration-700 ease-out {{ $index === 0 ? 'block' : 'hidden opacity-0' }}" data-slide="{{ $index }}">
                    <!-- Small Tagline Badge -->
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-[#FFB703] text-xs font-bold uppercase tracking-wider">
                        <span class="w-2 h-2 rounded-full bg-[#FFB703] animate-pulse"></span>
                        <span>{!! $slide['badge'] !!}</span>
                    </div>

                    <!-- Display Headline -->
                    <h1 class="font-serif font-black text-3xl sm:text-4xl md:text-5xl lg:text-5xl xl:text-6xl text-white leading-[1.15] tracking-tight">
                        {!! $slide['title'] !!}
                    </h1>

                    <!-- Subtitle Description -->
                    <p class="text-sm sm:text-base md:text-lg text-white/90 leading-relaxed font-normal max-w-2xl">
                        {{ $slide['desc'] }}
                    </p>

                    <!-- Dual Action Buttons -->
                    <div class="flex flex-wrap items-center gap-3 sm:gap-4 pt-2 sm:pt-4">
                        <!-- Primary Gold Button -->
                        <a href="{{ $slide['primary_btn_url'] }}" class="inline-flex items-center gap-2 px-6 sm:px-7 py-3 sm:py-3.5 bg-[#FFB703] hover:bg-[#e5a502] text-[#1B4332] font-black text-xs sm:text-sm uppercase tracking-wider rounded-lg shadow-lg hover:scale-105 active:scale-95 transition-all">
                            <span>{{ $slide['primary_btn_text'] }}</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </a>

                        <!-- Secondary Transparent / White Border Button -->
                        <a href="{{ $slide['secondary_btn_url'] }}" class="inline-flex items-center gap-2 px-6 sm:px-7 py-3 sm:py-3.5 bg-black/20 hover:bg-black/35 border-2 border-white text-white font-black text-xs sm:text-sm uppercase tracking-wider rounded-lg backdrop-blur-sm hover:scale-105 active:scale-95 transition-all">
                            <span>{{ $slide['secondary_btn_text'] }}</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </a>
                    </div>
                </div>
            @endforeach

            <!-- Slider Pagination Dots -->
            <div class="flex items-center gap-2 pt-8 sm:pt-10" id="hero-dots-container">
                @foreach($slides as $index => $slide)
                    <button type="button" 
                            class="hero-dot transition-all cursor-pointer {{ $index === 0 ? 'w-8 h-2 rounded-full bg-[#FFB703]' : 'w-2.5 h-2.5 rounded-full bg-white/40 hover:bg-white/70' }}" 
                            data-slide="{{ $index }}" 
                            aria-label="Pindah ke slide {{ $index + 1 }}">
                    </button>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Signature Overlapping Floating Card Bar (5 Highlights - Responsive) -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 -mt-12 sm:-mt-16 lg:-mt-20 relative z-30 mb-8 sm:mb-12">
        <div class="bg-white rounded-2xl sm:rounded-3xl shadow-xl shadow-slate-900/10 border border-gray-100 p-4 sm:p-6 lg:p-7">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-3 sm:gap-4 lg:gap-0 lg:divide-x lg:divide-gray-100">
                <!-- Item 1: Pelayanan Digital -->
                <div class="flex items-center gap-3.5 lg:px-4 py-2 sm:py-3 rounded-xl bg-gray-50/70 sm:bg-transparent">
                    <div class="w-11 h-11 rounded-xl bg-[#2D6A4F]/10 text-[#2D6A4F] flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <rect x="2" y="3" width="20" height="14" rx="2" stroke-width="2"/>
                            <line x1="8" y1="21" x2="16" y2="21" stroke-width="2"/>
                            <line x1="12" y1="17" x2="12" y2="21" stroke-width="2"/>
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-xs sm:text-sm text-[#1B4332] leading-tight">Pelayanan Digital</h4>
                        <p class="text-[11px] text-gray-500 mt-0.5">Surat & lacak berkas mandiri</p>
                    </div>
                </div>

                <!-- Item 2: Aparatur Berdedikasi -->
                <div class="flex items-center gap-3.5 lg:px-4 py-2 sm:py-3 rounded-xl bg-gray-50/70 sm:bg-transparent">
                    <div class="w-11 h-11 rounded-xl bg-[#2D6A4F]/10 text-[#2D6A4F] flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-xs sm:text-sm text-[#1B4332] leading-tight">Aparatur Berdedikasi</h4>
                        <p class="text-[11px] text-gray-500 mt-0.5">Siap melayani sepenuh hati</p>
                    </div>
                </div>

                <!-- Item 3: Siaga Transportasi / Ambulans -->
                <div class="flex items-center gap-3.5 lg:px-4 py-2 sm:py-3 rounded-xl bg-gray-50/70 sm:bg-transparent">
                    <div class="w-11 h-11 rounded-xl bg-[#2D6A4F]/10 text-[#2D6A4F] flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h8m-8 4h8m-9 8h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM6 17h.01M18 17h.01"/>
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-xs sm:text-sm text-[#1B4332] leading-tight">Siaga Bencana & Warga</h4>
                        <p class="text-[11px] text-gray-500 mt-0.5">Tanggap darurat 24 jam</p>
                    </div>
                </div>

                <!-- Item 4: Lingkungan Hijau (Buruan Sae) -->
                <div class="flex items-center gap-3.5 lg:px-4 py-2 sm:py-3 rounded-xl bg-gray-50/70 sm:bg-transparent">
                    <div class="w-11 h-11 rounded-xl bg-[#2D6A4F]/10 text-[#2D6A4F] flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-xs sm:text-sm text-[#1B4332] leading-tight">Lingkungan Hijau</h4>
                        <p class="text-[11px] text-gray-500 mt-0.5">Buruan Sae & bank sampah</p>
                    </div>
                </div>

                <!-- Item 5: Fasilitas Lengkap -->
                <div class="flex items-center gap-3.5 lg:px-4 py-2 sm:py-3 rounded-xl bg-gray-50/70 sm:bg-transparent">
                    <div class="w-11 h-11 rounded-xl bg-[#2D6A4F]/10 text-[#2D6A4F] flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-xs sm:text-sm text-[#1B4332] leading-tight">Fasilitas Lengkap</h4>
                        <p class="text-[11px] text-gray-500 mt-0.5">Posyandu & sarana warga</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const totalSlides = {{ count($slides) }};
    let currentSlide = 0;
    let autoSlideInterval = null;

    const bgSlides = document.querySelectorAll('.hero-bg-slide');
    const contentSlides = document.querySelectorAll('.hero-content-slide');
    const dots = document.querySelectorAll('.hero-dot');
    const prevBtn = document.getElementById('hero-prev-btn');
    const nextBtn = document.getElementById('hero-next-btn');
    const container = document.getElementById('hero-carousel-container');

    function goToSlide(index) {
        currentSlide = (index + totalSlides) % totalSlides;

        bgSlides.forEach((slide, idx) => {
            if (idx === currentSlide) {
                slide.classList.remove('opacity-0', 'pointer-events-none');
                slide.classList.add('opacity-100');
            } else {
                slide.classList.remove('opacity-100');
                slide.classList.add('opacity-0', 'pointer-events-none');
            }
        });

        contentSlides.forEach((slide, idx) => {
            if (idx === currentSlide) {
                slide.classList.remove('hidden', 'opacity-0');
                slide.classList.add('block');
                setTimeout(() => slide.classList.remove('opacity-0'), 20);
            } else {
                slide.classList.add('hidden', 'opacity-0');
                slide.classList.remove('block');
            }
        });

        dots.forEach((dot, idx) => {
            if (idx === currentSlide) {
                dot.className = 'hero-dot transition-all cursor-pointer w-8 h-2 rounded-full bg-[#FFB703]';
            } else {
                dot.className = 'hero-dot transition-all cursor-pointer w-2.5 h-2.5 rounded-full bg-white/40 hover:bg-white/70';
            }
        });
    }

    function startAutoSlide() {
        stopAutoSlide();
        autoSlideInterval = setInterval(() => {
            goToSlide(currentSlide + 1);
        }, 6500);
    }

    function stopAutoSlide() {
        if (autoSlideInterval) {
            clearInterval(autoSlideInterval);
            autoSlideInterval = null;
        }
    }

    if (prevBtn) {
        prevBtn.addEventListener('click', () => {
            goToSlide(currentSlide - 1);
            startAutoSlide();
        });
    }

    if (nextBtn) {
        nextBtn.addEventListener('click', () => {
            goToSlide(currentSlide + 1);
            startAutoSlide();
        });
    }

    dots.forEach((dot) => {
        dot.addEventListener('click', () => {
            const slideIdx = parseInt(dot.dataset.slide, 10);
            goToSlide(slideIdx);
            startAutoSlide();
        });
    });

    if (container) {
        container.addEventListener('mouseenter', stopAutoSlide);
        container.addEventListener('mouseleave', startAutoSlide);
    }

    startAutoSlide();
});
</script>
