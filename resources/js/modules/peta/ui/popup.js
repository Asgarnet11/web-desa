export function renderFacilityPopup(properties) {
    const photoHtml = properties.foto
        ? `<div class="mb-2 overflow-hidden rounded-[12px] h-32 w-full bg-gray-100">
             <img src="${properties.foto}" alt="${properties.nama}" class="w-full h-full object-cover">
           </div>`
        : '';

    return `
        <div class="p-1 min-w-[220px] max-w-[280px] font-sans">
            ${photoHtml}
            <div class="inline-block px-2.5 py-0.5 mb-1.5 text-xs font-bold rounded-full" style="background-color: ${properties.warna}20; color: ${properties.warna};">
                ${properties.kategori || 'Fasilitas'}
            </div>
            <h4 class="font-display font-bold text-base text-[#1B4332] leading-snug mb-1">
                ${properties.nama}
            </h4>
            <p class="text-xs text-[#1F2D26]/80 mb-2 leading-relaxed">
                ${properties.alamat || 'Alamat tidak tersedia'}
            </p>
            ${properties.kondisi ? `
                <div class="flex items-center gap-1.5 text-[11px] font-semibold text-[#1F2D26]/70">
                    <span>Kondisi:</span>
                    <span class="px-2 py-0.5 rounded-full bg-emerald-50 text-emerald-800 text-[10px]">${properties.kondisi}</span>
                </div>
            ` : ''}
        </div>
    `;
}
