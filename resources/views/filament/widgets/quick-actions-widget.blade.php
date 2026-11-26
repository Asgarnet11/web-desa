<div class="rounded-xl border border-gray-200 dark:border-zinc-800 bg-white dark:bg-zinc-900 overflow-hidden">
    <div class="px-5 py-3.5 border-b border-gray-200 dark:border-zinc-800 flex flex-col sm:flex-row sm:items-center justify-between gap-1">
        <h2 class="text-sm font-semibold text-gray-950 dark:text-white tracking-tight">
            {{ $heading }}
        </h2>
        <p class="text-xs text-gray-500 dark:text-zinc-400">
            {{ $subheading }}
        </p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-px bg-gray-200 dark:bg-zinc-800">
        @foreach ($actions as $action)
            <a
                href="{{ $action['url'] }}"
                @if (! empty($action['external'])) target="_blank" rel="noopener noreferrer" @endif
                class="group bg-white dark:bg-zinc-900 hover:bg-gray-50 dark:hover:bg-zinc-800/70 px-5 py-4 flex items-start justify-between gap-3 transition-colors"
            >
                <div class="flex items-start gap-3 min-w-0">
                    <span class="mt-0.5 text-gray-400 group-hover:text-[#1B4332] dark:text-zinc-500 dark:group-hover:text-emerald-400 transition-colors shrink-0">
                        @if ($action['icon'] === 'map')
                            <svg class="w-4 h-4" style="width: 16px; height: 16px;" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" /></svg>
                        @elseif ($action['icon'] === 'globe')
                            <svg class="w-4 h-4" style="width: 16px; height: 16px;" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg>
                        @elseif ($action['icon'] === 'chat')
                            <svg class="w-4 h-4" style="width: 16px; height: 16px;" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" /></svg>
                        @elseif ($action['icon'] === 'users')
                            <svg class="w-4 h-4" style="width: 16px; height: 16px;" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                        @elseif ($action['icon'] === 'wrench')
                            <svg class="w-4 h-4" style="width: 16px; height: 16px;" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M14.7 6.3a1 1 0 000 1.4l1.6 1.6a1 1 0 001.4 0l3.77-3.77a6 6 0 01-7.94 7.94l-6.91 6.91a2.12 2.12 0 01-3-3l6.91-6.91a6 6 0 017.94-7.94l-3.76 3.76z" /></svg>
                        @elseif ($action['icon'] === 'building')
                            <svg class="w-4 h-4" style="width: 16px; height: 16px;" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                        @elseif ($action['icon'] === 'storefront')
                            <svg class="w-4 h-4" style="width: 16px; height: 16px;" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M3 3h18l-2 9H5L3 3zm0 9v9a1 1 0 001 1h16a1 1 0 001-1v-9M9 21v-6a2 2 0 012-2h2a2 2 0 012 2v6" /></svg>
                        @elseif ($action['icon'] === 'map-pin')
                            <svg class="w-4 h-4" style="width: 16px; height: 16px;" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                        @elseif ($action['icon'] === 'newspaper')
                            <svg class="w-4 h-4" style="width: 16px; height: 16px;" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" /></svg>
                        @elseif ($action['icon'] === 'document')
                            <svg class="w-4 h-4" style="width: 16px; height: 16px;" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                        @elseif ($action['icon'] === 'shield')
                            <svg class="w-4 h-4" style="width: 16px; height: 16px;" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
                        @else
                            <svg class="w-4 h-4" style="width: 16px; height: 16px;" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                        @endif
                    </span>

                    <div class="min-w-0">
                        <div class="text-[13px] font-semibold text-gray-900 dark:text-zinc-100 group-hover:text-[#1B4332] dark:group-hover:text-emerald-400 transition-colors">
                            {{ $action['label'] }}
                        </div>
                        <div class="text-xs text-gray-500 dark:text-zinc-400 mt-0.5 truncate">
                            {{ $action['sub'] }}
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-2 shrink-0 mt-0.5">
                    @if (! empty($action['badge']))
                        <span class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-medium bg-amber-50 text-amber-900 border border-amber-200 dark:bg-amber-950/60 dark:text-amber-300 dark:border-amber-800 whitespace-nowrap tabular-nums">
                            {{ $action['badge'] }}
                        </span>
                    @endif
                    <svg class="w-3.5 h-3.5 text-gray-300 group-hover:text-gray-600 dark:text-zinc-600 dark:group-hover:text-zinc-300 transition-colors shrink-0" style="width: 14px; height: 14px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                        @if (! empty($action['external']))
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7 17L17 7M7 7h10v10" />
                        @else
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        @endif
                    </svg>
                </div>
            </a>
        @endforeach
    </div>
</div>
