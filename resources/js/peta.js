import { initMap } from './modules/peta/init-map';
import { fetchBatasWilayah, fetchFasilitasGeoJson } from './modules/peta/api-client';
import { createBoundaryLayer } from './modules/peta/layers/boundary-layer';
import { createFacilityLayer } from './modules/peta/layers/facility-layer';

document.addEventListener('DOMContentLoaded', async () => {
    const mapElement = document.getElementById('map');
    if (!mapElement) return;

    const initialLat = parseFloat(mapElement.dataset.lat) || -6.8872;
    const initialLng = parseFloat(mapElement.dataset.lng) || 107.5765;

    const map = initMap('map', {
        center: [initialLat, initialLng],
        zoom: 15
    });

    let currentFacilityLayer = null;

    try {
        // 1. Boundary layer
        const boundaryGeoJson = await fetchBatasWilayah();
        if (boundaryGeoJson) {
            const boundaryLayer = createBoundaryLayer(boundaryGeoJson);
            if (boundaryLayer) {
                boundaryLayer.addTo(map);
                map.fitBounds(boundaryLayer.getBounds(), { padding: [20, 20] });
            }
        }

        // 2. Initial facilities
        const fasilitasGeoJson = await fetchFasilitasGeoJson();
        currentFacilityLayer = createFacilityLayer(fasilitasGeoJson);
        currentFacilityLayer.addTo(map);
    } catch (err) {
        console.error('Error loading map data:', err);
    }

    // 3. Filter category clicks
    const filterButtons = document.querySelectorAll('[data-category-filter]');
    filterButtons.forEach(btn => {
        btn.addEventListener('click', async () => {
            filterButtons.forEach(b => b.classList.remove('bg-[#2D6A4F]', 'text-white'));
            btn.classList.add('bg-[#2D6A4F]', 'text-white');

            const catId = btn.dataset.categoryFilter;
            const params = catId === 'all' ? {} : { kategori_id: catId };

            if (currentFacilityLayer) {
                map.removeLayer(currentFacilityLayer);
            }

            const filteredData = await fetchFasilitasGeoJson(params);
            currentFacilityLayer = createFacilityLayer(filteredData);
            currentFacilityLayer.addTo(map);
        });
    });
});
