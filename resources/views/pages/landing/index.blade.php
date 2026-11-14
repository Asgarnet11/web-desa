<x-layouts.app :title="'Profil Kelurahan Sukawarna & Peta Digital'">
    @php
        $pengaturan = $data['pengaturan'] ?? [];
    @endphp

    @if($pengaturan['hero'] ?? true)
        <x-landing.hero :data="$data" />
    @endif

    @if($pengaturan['profil_sejarah'] ?? true)
        <x-landing.profil-sejarah :data="$data" />
    @endif

    @if($pengaturan['visi_misi'] ?? true)
        <x-landing.visi-misi :data="$data" />
    @endif

    @if($pengaturan['struktur_organisasi'] ?? true)
        <x-landing.struktur-organisasi :data="$data" />
    @endif

    @if($pengaturan['wilayah_statistik'] ?? true)
        <x-landing.wilayah-statistik :data="$data" />
    @endif

    @if($pengaturan['peta_interaktif'] ?? true)
        <x-landing.peta-ringkas :data="$data" />
    @endif

    @if($pengaturan['layanan'] ?? true)
        <x-landing.layanan :data="$data" />
    @endif

    @if($pengaturan['umkm'] ?? true)
        <x-landing.umkm :data="$data" />
    @endif

    @if($pengaturan['berita'] ?? true)
        <x-landing.berita :data="$data" />
    @endif

    @if($pengaturan['pengaduan_kontak'] ?? true)
        <x-landing.pengaduan-kontak :data="$data" />
    @endif

    @push('scripts')
        @vite('resources/js/landing.js')
    @endpush
</x-layouts.app>

