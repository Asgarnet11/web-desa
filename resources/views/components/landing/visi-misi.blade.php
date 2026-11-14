@props(['data'])

@php
    $profil = $data['profil'] ?? null;
    $misiList = $profil?->misi ?? [
        'Meningkatkan tata kelola pelayanan publik yang transparan, ramah, dan cepat berbasis digital.',
        'Mendorong kemandirian ekonomi warga melalui pemberdayaan UMKM lokal dan pertanian perkotaan ramah lingkungan.',
        'Mewujudkan lingkungan pemukiman yang bersih, hijau, tangguh bencana, dan berkelanjutan.',
        'Memperkuat kerukunan warga, kohesi sosial, dan ruang partisipasi aktif pemuda serta perempuan.'
    ];
@endphp

<section class="py-16 md:py-24 bg-[#FFF8E7]">
    <div class="max-w-7xl mx-auto px-6">
        <div class="bg-[#1B4332] text-[#FFF8E7] rounded-[40px] p-8 md:p-14 relative overflow-hidden shadow-soft border border-[#2D6A4F]">
            <!-- Glow background -->
            <div class="absolute top-0 right-0 w-80 h-80 bg-[#FFB703]/10 rounded-full blur-3xl pointer-events-none"></div>

            <div class="max-w-3xl space-y-4">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#52B788]/20 text-[#8ECFEA] text-xs font-bold uppercase tracking-wider">
                    Arah & Cita-Cita Wilayah
                </div>
                <h2 class="font-display font-bold text-3xl sm:text-4xl text-white leading-tight">
                    Visi & Misi Kelurahan
                </h2>
            </div>

            <!-- Visi Card -->
            <div class="mt-8 p-6 md:p-8 rounded-[28px] bg-white/10 backdrop-blur-sm border border-white/15">
                <span class="text-xs font-bold text-[#FFB703] uppercase tracking-wider block mb-2">Visi Utama</span>
                <p class="font-display font-bold text-xl sm:text-2xl text-white leading-relaxed">
                    &ldquo;{{ $profil?->visi ?? 'Terwujudnya Kelurahan Sukawarna yang Mandiri, Asri, Berdaya Saing Berbasis Komunitas dan Teknologi Ramah Lingkungan.' }}&rdquo;
                </p>
            </div>

            <!-- Misi Grid -->
            <div class="mt-8 space-y-3">
                <span class="text-xs font-bold text-[#FFB703] uppercase tracking-wider block mb-4">Misi Pembangunan</span>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($misiList as $index => $misi)
                        <div class="flex items-start gap-3.5 p-4 rounded-2xl bg-white/5 border border-white/10">
                            <div class="w-8 h-8 rounded-full bg-[#52B788] text-[#1B4332] flex-shrink-0 flex items-center justify-center font-bold text-sm">
                                {{ $index + 1 }}
                            </div>
                            <p class="text-xs sm:text-sm text-[#FFF8E7]/90 leading-relaxed pt-1">
                                {{ $misi }}
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
