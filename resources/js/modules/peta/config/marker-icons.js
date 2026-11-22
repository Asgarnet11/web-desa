import L from 'leaflet';

export const categoryColors = {
    'pendidikan': '#219EBC',
    'kesehatan': '#B3361A',
    'tempat-ibadah': '#2D6A4F',
    'pemerintahan': '#1B4332',
    'ekonomi-pasar': '#D97706',
    'infrastruktur-utilitas': '#78350F',
    'sosial-olahraga': '#059669',
    'default': '#2D6A4F'
};

export const categoryIcons = {
    'pendidikan': `
        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M22 10v6M2 10l10-5 10 5-10 5z"/>
            <path d="M6 12v5c3 3 9 3 12 0v-5"/>
        </svg>
    `,
    'kesehatan': `
        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 5v14M5 12h14"/>
        </svg>
    `,
    'tempat-ibadah': `
        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 2c-1.5 2.5-4 4-4 7a4 4 0 008 0c0-3-2.5-4.5-4-7z"/>
            <path d="M6 21v-7a2 2 0 012-2h8a2 2 0 012 2v7"/>
            <path d="M4 21h16"/>
        </svg>
    `,
    'pemerintahan': `
        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M3 21h18M5 21V10l7-5 7 5v11M9 10v11M15 10v11"/>
        </svg>
    `,
    'ekonomi-pasar': `
        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4zM3 6h18M16 10a4 4 0 01-8 0"/>
        </svg>
    `,
    'infrastruktur-utilitas': `
        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M14.7 6.3a1 1 0 000 1.4l1.6 1.6a1 1 0 001.4 0l3.77-3.77a6 6 0 01-7.94 7.94l-6.91 6.91a2.12 2.12 0 01-3-3l6.91-6.91a6 6 0 017.94-7.94l-3.76 3.76z"/>
        </svg>
    `,
    'sosial-olahraga': `
        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M6 9H4.5a2.5 2.5 0 010-5H6M18 9h1.5a2.5 2.5 0 000-5H18M4 22h16M10 14.66V17c0 .55-.45 1-1 1H8v4h8v-4h-1c-.55 0-1-.45-1-1v-2.34M18 4H6v7a6 6 0 0012 0V4z"/>
        </svg>
    `,
    'default': `
        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="3.5"></circle>
        </svg>
    `
};

export function createCategoryIcon(kategoriSlug = 'default', color = null) {
    const bg = color || categoryColors[kategoriSlug] || categoryColors.default;
    const isGold = bg === '#FFB703' || bg === '#D97706';
    const textColor = isGold ? '#FFFFFF' : '#FFFFFF';
    const iconSvg = categoryIcons[kategoriSlug] || categoryIcons.default;

    const html = `
        <div class="custom-marker-pin" style="
            background-color: ${bg};
            width: 38px;
            height: 38px;
            border-radius: 50% 50% 50% 0;
            transform: rotate(-45deg);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.28), 0 2px 6px rgba(0, 0, 0, 0.15);
            border: 2.5px solid #FFFFFF;
            cursor: pointer;
            transition: transform 0.2s cubic-bezier(0.34, 1.56, 0.64, 1);
        ">
            <div style="
                transform: rotate(45deg);
                color: ${textColor};
                display: flex;
                align-items: center;
                justify-content: center;
            ">
                ${iconSvg}
            </div>
        </div>
    `;

    return L.divIcon({
        className: 'custom-map-marker',
        html: html,
        iconSize: [38, 38],
        iconAnchor: [19, 38],
        popupAnchor: [0, -40]
    });
}
