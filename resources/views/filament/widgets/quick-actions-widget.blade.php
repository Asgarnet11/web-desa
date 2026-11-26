<x-filament::section>
    <x-slot name="heading">
        <div class="flex items-center gap-2">
            <span class="w-2.5 h-2.5 rounded-full bg-[#2D6A4F]"></span>
            <span class="font-bold text-sm tracking-wide text-gray-900 dark:text-white uppercase">{{ $heading }}</span>
        </div>
    </x-slot>

    <x-slot name="description">
        {{ $subheading }}
    </x-slot>

    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-3 pt-2">
        @foreach($actions as $action)
            @php
                $colorThemes = match($action['color']) {
                    'sky' => [
                        'card' => 'bg-sky-50/70 hover:bg-sky-100/90 dark:bg-sky-950/40 dark:hover:bg-sky-900/60 border-sky-200 dark:border-sky-800',
                        'icon_bg' => 'bg-[#0284C7]',
                        'title' => 'text-sky-950 dark:text-sky-100',
                        'sub' => 'text-sky-700 dark:text-sky-300',
                    ],
                    'emerald' => [
                        'card' => 'bg-emerald-50/70 hover:bg-emerald-100/90 dark:bg-emerald-950/40 dark:hover:bg-emerald-900/60 border-emerald-200 dark:border-emerald-800',
                        'icon_bg' => 'bg-[#1B4332]',
                        'title' => 'text-emerald-950 dark:text-emerald-100',
                        'sub' => 'text-emerald-700 dark:text-emerald-300',
                    ],
                    'amber' => [
                        'card' => 'bg-amber-50/70 hover:bg-amber-100/90 dark:bg-amber-950/40 dark:hover:bg-amber-900/60 border-amber-200 dark:border-amber-800',
                        'icon_bg' => 'bg-[#D97706]',
                        'title' => 'text-amber-950 dark:text-amber-100',
                        'sub' => 'text-amber-700 dark:text-amber-300',
                    ],
                    'orange' => [
                        'card' => 'bg-orange-50/70 hover:bg-orange-100/90 dark:bg-orange-950/40 dark:hover:bg-orange-900/60 border-orange-200 dark:border-orange-800',
                        'icon_bg' => 'bg-[#EA580C]',
                        'title' => 'text-orange-950 dark:text-orange-100',
                        'sub' => 'text-orange-700 dark:text-orange-300',
                    ],
                    'teal' => [
                        'card' => 'bg-teal-50/70 hover:bg-teal-100/90 dark:bg-teal-950/40 dark:hover:bg-teal-900/60 border-teal-200 dark:border-teal-800',
                        'icon_bg' => 'bg-[#0D9488]',
                        'title' => 'text-teal-950 dark:text-teal-100',
                        'sub' => 'text-teal-700 dark:text-teal-300',
                    ],
                    'indigo' => [
                        'card' => 'bg-indigo-50/70 hover:bg-indigo-100/90 dark:bg-indigo-950/40 dark:hover:bg-indigo-900/60 border-indigo-200 dark:border-indigo-800',
                        'icon_bg' => 'bg-[#4F46E5]',
                        'title' => 'text-indigo-950 dark:text-indigo-100',
                        'sub' => 'text-indigo-700 dark:text-indigo-300',
                    ],
                    'purple' => [
                        'card' => 'bg-purple-50/70 hover:bg-purple-100/90 dark:bg-purple-950/40 dark:hover:bg-purple-900/60 border-purple-200 dark:border-purple-800',
                        'icon_bg' => 'bg-[#7C3AED]',
                        'title' => 'text-purple-950 dark:text-purple-100',
                        'sub' => 'text-purple-700 dark:text-purple-300',
                    ],
                    default => [
                        'card' => 'bg-slate-50/70 hover:bg-slate-100/90 dark:bg-slate-950/40 dark:hover:bg-slate-900/60 border-slate-200 dark:border-slate-800',
                        'icon_bg' => 'bg-[#2D6A4F]',
                        'title' => 'text-slate-950 dark:text-slate-100',
                        'sub' => 'text-slate-700 dark:text-slate-300',
                    ],
                };
            @endphp

            <a href="{{ $action['url'] }}" 
               @if(!empty($action['external'])) target="_blank" rel="noopener noreferrer" @endif
               class="group relative flex flex-col items-center p-3.5 rounded-2xl {{ $colorThemes['card'] }} border transition-all text-center hover:scale-[1.02]">
                
                @if(!empty($action['badge']))
                    <span class="absolute -top-2 -right-1 px-2 py-0.5 rounded-full text-[9px] font-extrabold bg-red-600 text-white shadow-sm animate-bounce">
                        {{ $action['badge'] }}
                    </span>
                @endif

                <div class="w-10 h-10 rounded-xl {{ $colorThemes['icon_bg'] }} text-white flex items-center justify-center shadow-sm group-hover:scale-110 transition-transform mb-2">
                    @if($action['icon'] === 'map')
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/></svg>
                    @elseif($action['icon'] === 'globe')
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    @elseif($action['icon'] === 'chat')
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                    @elseif($action['icon'] === 'users')
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    @elseif($action['icon'] === 'wrench')
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    @elseif($action['icon'] === 'building')
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    @elseif($action['icon'] === 'storefront')
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h18l-2 9H5L3 3zm0 9v9a1 1 0 001 1h16a1 1 0 001-1v-9M9 21v-6a2 2 0 012-2h2a2 2 0 012 2v6"/></svg>
                    @elseif($action['icon'] === 'map-pin')
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    @elseif($action['icon'] === 'newspaper')
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                    @elseif($action['icon'] === 'document')
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    @elseif($action['icon'] === 'shield')
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    @else
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    @endif
                </div>

                <span class="font-bold text-xs {{ $colorThemes['title'] }}">{{ $action['label'] }}</span>
                <span class="text-[10px] {{ $colorThemes['sub'] }} mt-0.5 truncate max-w-full">{{ $action['sub'] }}</span>
            </a>
        @endforeach
    </div>
</x-filament::section>
