import L from 'leaflet';
import { getChoroplethColor } from '../config/choropleth-scale';

export function createChoroplethLayer(geojsonData) {
    if (!geojsonData || !geojsonData.features) return null;

    return L.geoJSON(geojsonData, {
        style: (feature) => {
            const value = feature.properties.nilai || 0;
            return {
                fillColor: getChoroplethColor(value),
                weight: 2,
                opacity: 1,
                color: '#FFFFFF',
                fillOpacity: 0.7
            };
        },
        onEachFeature: (feature, layer) => {
            layer.bindTooltip(`<b>${feature.properties.label}</b>`, {
                sticky: true,
                className: 'rounded-xl px-2.5 py-1 font-sans text-xs bg-white text-[#1B4332] shadow-md'
            });
        }
    });
}
