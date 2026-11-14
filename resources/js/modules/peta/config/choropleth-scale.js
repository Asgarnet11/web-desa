export const choroplethPalette = [
    '#E4F4EA', // Level 1 (sangat rendah)
    '#B7E4C7', // Level 2 (rendah)
    '#74C69D', // Level 3 (sedang)
    '#2D6A4F', // Level 4 (tinggi)
    '#1B4332'  // Level 5 (sangat tinggi)
];

export function getChoroplethColor(value, min = 1000, max = 5000) {
    if (!value) return choroplethPalette[0];
    const range = (max - min) / 5;
    if (value <= min + range) return choroplethPalette[0];
    if (value <= min + range * 2) return choroplethPalette[1];
    if (value <= min + range * 3) return choroplethPalette[2];
    if (value <= min + range * 4) return choroplethPalette[3];
    return choroplethPalette[4];
}
