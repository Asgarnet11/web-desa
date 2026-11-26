<x-filament-panels::page.simple>
    {{-- Login Form First --}}
    <div class="space-y-6">
        {{ $this->content }}

        {{-- Compact Institutional Role Demo Selector (Tucked Quietly Below Primary Action) --}}
        <div class="pt-5 border-t border-gray-200 dark:border-zinc-800">
            <div class="flex items-center justify-between gap-2 mb-3">
                <span class="text-[11px] font-semibold uppercase tracking-wider text-gray-500 dark:text-zinc-400">
                    Akun Pengujian Peran
                </span>
                @if ($selectedDemoEmail)
                    <span class="text-[11px] font-medium text-[#1B4332] dark:text-emerald-400">
                        Terisi: {{ $selectedDemoEmail }}
                    </span>
                @endif
            </div>

            @php
                $demoAccounts = [
                    [
                        'role' => 'Pimpinan (Lurah)',
                        'email' => 'lurah@kelurahan.test',
                        'scope' => 'Disposisi & KPI Eksekutif',
                    ],
                    [
                        'role' => 'Operator Loket',
                        'email' => 'operator@kelurahan.test',
                        'scope' => 'Adminduk, Aduan & UMKM',
                    ],
                    [
                        'role' => 'Ketua RT 01 / RW 01',
                        'email' => 'rt01@kelurahan.test',
                        'scope' => 'Pelaporan Mutasi LAMPID',
                    ],
                    [
                        'role' => 'Kader Kesehatan',
                        'email' => 'kader@kelurahan.test',
                        'scope' => 'Pemantauan Bumil & Balita',
                    ],
                    [
                        'role' => 'Admin Wilayah',
                        'email' => 'admin@kelurahan.test',
                        'scope' => 'Supervisi Kec. Sukasari',
                    ],
                    [
                        'role' => 'Super Admin',
                        'email' => 'superadmin@kelurahan.test',
                        'scope' => 'Hak Akses & Audit Trail',
                    ],
                ];
            @endphp

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                @foreach ($demoAccounts as $account)
                    @php
                        $isSelected = $selectedDemoEmail === $account['email'];
                    @endphp
                    <button
                        type="button"
                        wire:click="selectRole('{{ $account['email'] }}')"
                        @class([
                            'group text-left rounded-lg border px-3 py-2.5 transition-colors cursor-pointer focus:outline-none focus:ring-2 focus:ring-[#1B4332]/30',
                            'border-[#1B4332] bg-[#1B4332]/5 dark:border-emerald-500 dark:bg-emerald-950/30' => $isSelected,
                            'border-gray-200 bg-gray-50/70 hover:bg-white hover:border-gray-300 dark:border-zinc-800 dark:bg-zinc-900/70 dark:hover:border-zinc-700' => ! $isSelected,
                        ])
                    >
                        <div class="flex items-center justify-between gap-2">
                            <span class="text-xs font-semibold text-gray-900 dark:text-zinc-100">
                                {{ $account['role'] }}
                            </span>
                            <span @class([
                                'h-1.5 w-1.5 rounded-full shrink-0',
                                'bg-[#1B4332] dark:bg-emerald-400' => $isSelected,
                                'bg-gray-300 dark:bg-zinc-700 group-hover:bg-gray-400' => ! $isSelected,
                            ])></span>
                        </div>
                        <span class="block text-[11px] font-mono text-gray-600 dark:text-zinc-400 truncate mt-0.5 tabular-nums">
                            {{ $account['email'] }}
                        </span>
                        <span class="block text-[11px] text-gray-500 dark:text-zinc-500 truncate mt-0.5">
                            {{ $account['scope'] }}
                        </span>
                    </button>
                @endforeach
            </div>
        </div>

        {{-- Footer Bar: Back Link & Audit Notice --}}
        <div class="pt-4 border-t border-gray-200 dark:border-zinc-800 flex flex-col sm:flex-row sm:items-center justify-between gap-2 text-xs text-gray-500 dark:text-zinc-400">
            <a
                href="/"
                class="inline-flex items-center gap-1.5 font-medium text-gray-700 hover:text-[#1B4332] dark:text-zinc-300 dark:hover:text-emerald-400 transition-colors"
            >
                <svg class="w-3.5 h-3.5 shrink-0" style="width: 14px; height: 14px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                <span>Kembali ke Portal Publik</span>
            </a>

            <a href="/regulasi" class="inline-flex items-center gap-1.5 text-[11px] text-gray-500 hover:text-[#1B4332] dark:text-zinc-400 dark:hover:text-emerald-400 transition-colors">
                <svg class="w-3.5 h-3.5 shrink-0 text-gray-400 dark:text-zinc-500" style="width: 14px; height: 14px;" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
                <span>Kepatuhan UU PDP &amp; Audit Aktif</span>
            </a>
        </div>
    </div>
</x-filament-panels::page.simple>
