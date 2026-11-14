import L from 'leaflet';

export function createBoundaryLayer(geojsonData) {
    if (!geojsonData) return null;

    return L.geoJSON(geojsonData, {
        style: {
            color: '#2D6A4F',
            weight: 3,
            opacity: 0.9,
            fillColor: '#52B788',
            fillOpacity: 0.15
        },
        onEachFeature: (feature, layer) => {
            if (feature.properties && feature.properties.nama) {
                layer.bindTooltip(`<b>${feature.properties.nama}</b>`, {
                    sticky: true,
                    className: 'rounded-xl px-2 py-1 shadow-sm font-sans text-xs bg-white text-[#1B4332]'
                });
            }
        }
    });
}
