import { initCountUp } from './modules/ui/count-up';
import { initMap } from './modules/peta/init-map';
import { fetchBatasWilayah, fetchFasilitasGeoJson } from './modules/peta/api-client';
import { createBoundaryLayer } from './modules/peta/layers/boundary-layer';
import { createFacilityLayer } from './modules/peta/layers/facility-layer';

document.addEventListener('DOMContentLoaded', async () => {
    // 1. Animated stats numbers
    initCountUp();

    // 2. Interactive Landing Map
    const miniMapElement = document.getElementById('landing-map');
    if (miniMapElement) {
        const lat = parseFloat(miniMapElement.dataset.lat) || -6.8872;
        const lng = parseFloat(miniMapElement.dataset.lng) || 107.5765;

        const map = initMap('landing-map', {
            center: [lat, lng],
            zoom: 15,
            scrollWheelZoom: false
        });

        try {
            const boundary = await fetchBatasWilayah();
            if (boundary) {
                const bLayer = createBoundaryLayer(boundary);
                bLayer.addTo(map);
                map.fitBounds(bLayer.getBounds(), { padding: [15, 15] });
            }

            const fasilitas = await fetchFasilitasGeoJson();
            const fLayer = createFacilityLayer(fasilitas);
            fLayer.addTo(map);
        } catch (e) {
            console.error('Failed to load landing map:', e);
        }
    }
});
