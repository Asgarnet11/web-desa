import L from 'leaflet';

export const categoryColors = {
    'pendidikan': '#219EBC',
    'kesehatan': '#B3361A',
    'tempat-ibadah': '#2D6A4F',
    'pemerintahan': '#1B4332',
    'ekonomi-pasar': '#FFB703',
    'infrastruktur-utilitas': '#6B4226',
    'sosial-olahraga': '#52B788',
    'default': '#2D6A4F'
};

export function createCategoryIcon(kategoriSlug = 'default', color = null) {
    const bg = color || categoryColors[kategoriSlug] || categoryColors.default;
    const isGold = bg === '#FFB703';
    const textColor = isGold ? '#1B4332' : '#FFFFFF';

    const html = `
        <div style="
            background-color: ${bg};
            width: 36px;
            height: 36px;
            border-radius: 50% 50% 50% 0;
            transform: rotate(-45deg);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(31, 45, 38, 0.25);
            border: 2px solid #FFFFFF;
        ">
            <div style="
                transform: rotate(45deg);
                color: ${textColor};
                font-size: 16px;
                font-weight: bold;
                display: flex;
                align-items: center;
                justify-content: center;
            ">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="3"></circle>
                </svg>
            </div>
        </div>
    `;

    return L.divIcon({
        className: 'custom-map-marker',
        html: html,
        iconSize: [36, 36],
        iconAnchor: [18, 36],
        popupAnchor: [0, -36]
    });
}

