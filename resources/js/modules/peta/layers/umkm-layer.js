import L from 'leaflet';
import { createCategoryIcon } from '../config/marker-icons';
import { renderUmkmPopup } from '../ui/popup';

export function createUmkmLayer(geojsonData) {
    if (!geojsonData || !geojsonData.features) return L.layerGroup();

    const layerGroup = L.layerGroup();

    geojsonData.features.forEach((feature) => {
        const coords = feature.geometry.coordinates; // [lng, lat]
        const props = feature.properties;

        const icon = createCategoryIcon('umkm', props.warna || '#EA580C');
        const marker = L.marker([coords[1], coords[0]], { icon });

        marker.bindPopup(renderUmkmPopup(props, coords), {
            className: 'solarpunk-map-popup',
            maxWidth: 320,
            closeButton: false,
            offset: [0, -10]
        });

        // Store feature reference and custom ID on marker
        marker.feature = feature;
        marker.umkmId = props.id;
        marker.isUmkm = true;
        layerGroup.addLayer(marker);
    });

    return layerGroup;
}
