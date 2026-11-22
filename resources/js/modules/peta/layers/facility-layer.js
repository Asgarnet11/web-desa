import L from 'leaflet';
import { createCategoryIcon } from '../config/marker-icons';
import { renderFacilityPopup } from '../ui/popup';

export function createFacilityLayer(geojsonData) {
    if (!geojsonData || !geojsonData.features) return L.layerGroup();

    const layerGroup = L.layerGroup();

    geojsonData.features.forEach((feature) => {
        const coords = feature.geometry.coordinates; // [lng, lat]
        const props = feature.properties;

        const icon = createCategoryIcon(props.kategori_slug, props.warna);
        const marker = L.marker([coords[1], coords[0]], { icon });

        marker.bindPopup(renderFacilityPopup(props, coords), {
            className: 'solarpunk-map-popup',
            maxWidth: 320,
            closeButton: false,
            offset: [0, -10]
        });

        // Store feature reference and custom ID on marker for quick programmatic access
        marker.feature = feature;
        marker.facilityId = props.id;
        layerGroup.addLayer(marker);
    });

    return layerGroup;
}
