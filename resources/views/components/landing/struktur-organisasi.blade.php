@props(['data'])

@php
    $perangkatList = $data['perangkat'] ?? collect();
    $lurah = $perangkatList->first();
    $staf = $perangkatList->slice(1);
@endphp

<section class="py-16 md:py-24 bg-white">
    <div class="max-w-7xl mx-auto px-6 space-y-12">
        <div class="text-center max-w-2xl mx-auto space-y-3">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#52B788]/20 text-[#1B4332] text-xs font-bold uppercase tracking-wider">
                Aparatur Kelurahan
            </div>
            <h2 class="font-display font-bold text-3xl sm:text-4xl text-[#1B4332]">
                Struktur Organisasi & Pelayan Warga
            </h2>
            <p class="text-sm text-[#1F2D26]/75">
                Aparatur sipil negara dan staf kelurahan yang berdedikasi melayani seluruh kebutuhan administrasi dan kemasyarakatan.
            </p>
        </div>

        @if($lurah)
            <!-- Lurah Card (Featured Larger) -->
            <div class="max-w-xl mx-auto bg-gradient-to-br from-[#FFF8E7] to-white rounded-[32px] p-6 border-2 border-[#52B788]/40 shadow-soft flex flex-col sm:flex-row items-center gap-6">
                <div class="w-28 h-28 sm:w-32 sm:w-32 rounded-[24px] overflow-hidden flex-shrink-0 bg-gray-100 border-2 border-[#52B788]">
                    <img src="{{ $lurah->foto ?? 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=400&q=80' }}" 
                         alt="{{ $lurah->nama }}" 
                         class="w-full h-full object-cover">
                </div>
                <div class="space-y-1.5 text-center sm:text-left">
                    <span class="inline-block px-3 py-0.5 rounded-full bg-[#2D6A4F] text-[#FFF8E7] text-[11px] font-bold">
                        {{ $lurah->jabatan }}
                    </span>
                    <h3 class="font-display font-bold text-xl text-[#1B4332]">{{ $lurah->nama }}</h3>
                    <p class="text-xs text-[#17708A] font-mono">NIP: {{ $lurah->nip ?? '-' }}</p>
                    <p class="text-xs text-[#1F2D26]/70 pt-1">Memimpin koordinasi pemerintahan, pembangunan fisik, dan ketenteraman warga Sukawarna.</p>
                </div>
            </div>
        @endif

        <!-- Other Officers Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($staf as $p)
                <div class="bg-white rounded-[24px] p-5 border border-[#52B788]/20 shadow-soft shadow-hover space-y-4 flex flex-col items-center text-center">
                    <div class="w-20 h-20 rounded-[20px] overflow-hidden bg-gray-100 border border-[#52B788]/30">
                        <img src="{{ $p->foto ?? 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=400&q=80' }}" 
                             alt="{{ $p->nama }}" 
                             class="w-full h-full object-cover">
                    </div>
                    <div class="space-y-1">
                        <span class="inline-block px-2.5 py-0.5 rounded-full bg-[#52B788]/15 text-[#1B4332] text-[10px] font-bold">
                            {{ $p->jabatan }}
                        </span>
                        <h4 class="font-display font-bold text-sm text-[#1B4332]">{{ $p->nama }}</h4>
                        <p class="text-[11px] text-[#17708A] font-mono">{{ $p->nip ?? '-' }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

