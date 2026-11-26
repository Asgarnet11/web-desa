export function renderFacilityPopup(properties, coordinates = null) {
    const lat = coordinates ? coordinates[1] : null;
    const lng = coordinates ? coordinates[0] : null;
    const directionsUrl = (lat && lng) 
        ? `https://www.google.com/maps/dir/?api=1&destination=${lat},${lng}`
        : null;

    const photoHtml = properties.foto
        ? `<div class="relative h-36 w-full overflow-hidden bg-slate-100">
             <img src="${properties.foto}" alt="${properties.nama}" class="w-full h-full object-cover">
             <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
             <div class="absolute bottom-2 left-3 right-3 flex items-center justify-between text-[11px] text-white">
                <span class="inline-flex items-center gap-1 font-semibold drop-shadow-md">
                    <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                    <span>${properties.kondisi || 'Baik'}</span>
                </span>
                <span class="bg-black/40 backdrop-blur-md px-2 py-0.5 rounded text-[10px] font-medium">
                    ${properties.kategori || 'Fasilitas'}
                </span>
             </div>
           </div>`
        : `<div class="p-3 pb-0 flex items-center justify-between">
             <span class="inline-flex items-center gap-1.5 px-2.5 py-1 text-[11px] font-bold rounded-full" style="background-color: ${properties.warna}18; color: ${properties.warna};">
                 ${properties.kategori || 'Fasilitas Publik'}
             </span>
             ${properties.kondisi ? `
                 <span class="px-2 py-0.5 rounded-full bg-emerald-50 text-emerald-800 text-[10px] font-bold border border-emerald-200">
                     ● ${properties.kondisi}
                 </span>
             ` : ''}
           </div>`;

    return `
        <div class="font-sans overflow-hidden rounded-2xl bg-white shadow-xl min-w-[260px] max-w-[320px]">
            ${photoHtml}
            <div class="p-4 space-y-2.5">
                <div>
                    <h4 class="font-serif font-black text-sm sm:text-base text-[#0F172A] leading-snug tracking-tight">
                        ${properties.nama}
                    </h4>
                    <p class="text-xs text-gray-500 flex items-start gap-1.5 mt-1 leading-relaxed">
                        <svg class="w-3.5 h-3.5 text-gray-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span>${properties.alamat || 'Kelurahan Sukawarna, Sukasari, Kota Bandung'}</span>
                    </p>
                </div>

                ${properties.keterangan ? `
                    <p class="text-[11px] text-gray-600 line-clamp-2 leading-relaxed bg-gray-50 p-2 rounded-lg border border-gray-100">
                        ${properties.keterangan}
                    </p>
                ` : ''}

                <div class="pt-2 border-t border-gray-100 flex items-center justify-between gap-2">
                    ${directionsUrl ? `
                        <a href="${directionsUrl}" target="_blank" rel="noopener noreferrer" 
                           class="w-full inline-flex items-center justify-center gap-1.5 py-2 px-3 rounded-lg bg-[#0284C7] hover:bg-[#0369A1] text-white font-bold text-xs shadow-xs transition-colors">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            <span>Petunjuk Arah (Maps)</span>
                        </a>
                    ` : ''}
                </div>
            </div>
        </div>
    `;
}

export function renderUmkmPopup(properties, coordinates = null) {
    const lat = coordinates ? coordinates[1] : null;
    const lng = coordinates ? coordinates[0] : null;
    const directionsUrl = (lat && lng) 
        ? `https://www.google.com/maps/dir/?api=1&destination=${lat},${lng}`
        : null;

    const waNumber = properties.kontak_wa ? properties.kontak_wa.replace(/^0/, '62') : null;
    const waUrl = waNumber ? `https://wa.me/${waNumber}` : null;

    const photoHtml = properties.foto
        ? `<div class="relative h-36 w-full overflow-hidden bg-slate-100">
             <img src="${properties.foto}" alt="${properties.nama}" class="w-full h-full object-cover">
             <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
             <div class="absolute bottom-2 left-3 right-3 flex items-center justify-between text-[11px] text-white">
                <span class="inline-flex items-center gap-1 font-semibold drop-shadow-md">
                    <span class="w-2 h-2 rounded-full bg-amber-400"></span>
                    <span>UMKM Warga</span>
                </span>
                <span class="bg-black/40 backdrop-blur-md px-2 py-0.5 rounded text-[10px] font-medium">
                    ${properties.kategori || 'Produk Lokal'}
                </span>
             </div>
           </div>`
        : `<div class="p-3 pb-0 flex items-center justify-between">
             <span class="inline-flex items-center gap-1.5 px-2.5 py-1 text-[11px] font-bold rounded-full bg-orange-50 text-orange-600">
                 🛍️ UMKM Sukawarna &bull; ${properties.kategori || 'Produk'}
             </span>
             ${properties.is_unggulan ? `
                 <span class="px-2 py-0.5 rounded-full bg-amber-100 text-amber-800 text-[10px] font-bold">
                     ⭐ Unggulan
                 </span>
             ` : ''}
           </div>`;

    return `
        <div class="font-sans overflow-hidden rounded-2xl bg-white shadow-xl min-w-[260px] max-w-[320px]">
            ${photoHtml}
            <div class="p-4 space-y-2.5">
                <div>
                    <h4 class="font-serif font-black text-sm sm:text-base text-[#0F172A] leading-snug tracking-tight">
                        ${properties.nama}
                    </h4>
                    ${properties.nama_pemilik ? `
                        <p class="text-[11px] font-semibold text-[#17708A] mt-0.5">Pemilik: ${properties.nama_pemilik}</p>
                    ` : ''}
                    <p class="text-xs text-gray-500 flex items-start gap-1.5 mt-1 leading-relaxed">
                        <svg class="w-3.5 h-3.5 text-gray-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span>${properties.alamat || 'Kelurahan Sukawarna, Kota Bandung'}</span>
                    </p>
                </div>

                ${properties.deskripsi ? `
                    <p class="text-[11px] text-gray-600 line-clamp-2 leading-relaxed bg-orange-50/50 p-2 rounded-lg border border-orange-100">
                        ${properties.deskripsi}
                    </p>
                ` : ''}

                <div class="pt-2 border-t border-gray-100 flex flex-col gap-2">
                    ${waUrl ? `
                        <a href="${waUrl}" target="_blank" rel="noopener noreferrer" 
                           class="w-full inline-flex items-center justify-center gap-1.5 py-2 px-3 rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow-xs transition-colors">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/></svg>
                            <span>Hubungi Penjual (WhatsApp)</span>
                        </a>
                    ` : ''}

                    ${directionsUrl ? `
                        <a href="${directionsUrl}" target="_blank" rel="noopener noreferrer" 
                           class="w-full inline-flex items-center justify-center gap-1.5 py-1.5 px-3 rounded-lg border border-gray-200 hover:bg-gray-50 text-gray-700 font-bold text-[11px] transition-colors">
                            <svg class="w-3.5 h-3.5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            <span>Petunjuk Arah (Maps)</span>
                        </a>
                    ` : ''}
                </div>
            </div>
        </div>
    `;
}
