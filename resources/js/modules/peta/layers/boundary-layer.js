import L from 'leaflet';

export function createBoundaryLayer(geojsonData) {
    if (!geojsonData) return null;

    return L.geoJSON(geojsonData, {
        style: {
            color: '#1B4332',
            weight: 3.5,
            dashArray: '6, 6',
            opacity: 0.95,
            fillColor: '#2D6A4F',
            fillOpacity: 0.08
        },
        onEachFeature: (feature, layer) => {
            const props = feature.properties || {};
            const nama = props.nama || 'Wilayah Kelurahan Sukawarna';
            const luas = props.luas ? `${props.luas} km²` : null;

            layer.bindTooltip(`
                <div class="px-2 py-1 font-sans text-xs">
                    <span class="font-bold text-[#1B4332] block">${nama}</span>
                    ${luas ? `<span class="text-[10px] text-gray-500">Luas: ${luas}</span>` : ''}
                </div>
            `, {
                sticky: true,
                className: 'rounded-xl shadow-md border border-emerald-200 bg-white/95 backdrop-blur-sm'
            });

            layer.on({
                mouseover: (e) => {
                    const l = e.target;
                    l.setStyle({
                        weight: 4.5,
                        dashArray: '',
                        color: '#0284C7',
                        fillOpacity: 0.14
                    });
                },
                mouseout: (e) => {
                    const l = e.target;
                    l.setStyle({
                        weight: 3.5,
                        dashArray: '6, 6',
                        color: '#1B4332',
                        fillOpacity: 0.08
                    });
                }
            });
        }
    });
}
