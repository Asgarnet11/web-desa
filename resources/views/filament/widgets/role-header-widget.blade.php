<div class="rounded-xl border border-gray-200 dark:border-zinc-800 bg-gray-50/70 dark:bg-zinc-900/70 px-4 py-3 sm:px-5 flex flex-col lg:flex-row lg:items-center justify-between gap-3">
    <div class="flex flex-wrap items-center gap-x-3 gap-y-1.5 min-w-0">
        <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-semibold bg-[#1B4332]/10 text-[#1B4332] border border-[#1B4332]/20 dark:bg-emerald-950/60 dark:text-emerald-300 dark:border-emerald-800 shrink-0">
            {{ $roleBadge }}
        </span>
        <span class="text-xs text-gray-600 dark:text-zinc-400 leading-snug">
            {{ $roleContext }}
        </span>
    </div>

    <div class="flex flex-wrap items-center gap-2 shrink-0 text-xs">
        @if ($user?->isOperator() || $user?->isPimpinan())
            @if ($pendingPengaduan > 0)
                <a
                    href="/admin/pengaduans"
                    class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-amber-50 text-amber-900 border border-amber-200 hover:bg-amber-100 dark:bg-amber-950/50 dark:text-amber-200 dark:border-amber-800 font-medium tabular-nums transition-colors"
                >
                    <span class="w-1.5 h-1.5 rounded-full bg-amber-600 shrink-0"></span>
                    <span>{{ $pendingPengaduan }} pengaduan perlu verifikasi</span>
                </a>
            @else
                <span class="inline-flex items-center px-2.5 py-1 rounded-md bg-emerald-50 text-emerald-900 border border-emerald-200 dark:bg-emerald-950/40 dark:text-emerald-300 dark:border-emerald-800 font-medium">
                    Antrean pengaduan bersih
                </span>
            @endif

            @if ($pendingUmkm > 0)
                <a
                    href="/admin/umkms"
                    class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-white text-gray-800 border border-gray-200 hover:border-gray-300 dark:bg-zinc-900 dark:text-zinc-200 dark:border-zinc-700 font-medium tabular-nums transition-colors"
                >
                    <span>{{ $pendingUmkm }} UMKM menunggu kurasi</span>
                </a>
            @endif
        @elseif ($user?->isSuperAdmin() && $latestLog)
            <span class="text-[11px] text-gray-500 dark:text-zinc-400 tabular-nums">
                Log terakhir: {{ $latestLog->entitas }} ({{ $latestLog->aksi }}) · {{ $latestLog->created_at?->diffForHumans() }}
            </span>
        @else
            <span class="text-[11px] text-gray-500 dark:text-zinc-400 tabular-nums">
                Tanggal sistem: {{ now()->translatedFormat('d M Y') }}
            </span>
        @endif
    </div>
</div>
