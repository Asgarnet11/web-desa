import { initCountUp } from './modules/ui/count-up';
import { initMap, switchBasemap } from './modules/peta/init-map';
import { fetchBatasWilayah, fetchFasilitasGeoJson } from './modules/peta/api-client';
import { createBoundaryLayer } from './modules/peta/layers/boundary-layer';
import { createFacilityLayer } from './modules/peta/layers/facility-layer';

document.addEventListener('DOMContentLoaded', async () => {
    // 1. Animated stats numbers
    initCountUp();

    // 2. Interactive Landing Map
    const miniMapElement = document.getElementById('landing-map');
    if (miniMapElement) {
        const lat = parseFloat(miniMapElement.dataset.lat) || -4.124444;
        const lng = parseFloat(miniMapElement.dataset.lng) || 122.440278;

        const map = initMap('landing-map', {
            center: [lat, lng],
            zoom: 15,
            scrollWheelZoom: false
        });

        let boundaryLayer = null;
        let facilityLayer = null;

        try {
            const boundary = await fetchBatasWilayah();
            if (boundary) {
                boundaryLayer = createBoundaryLayer(boundary);
                if (boundaryLayer) {
                    boundaryLayer.addTo(map);
                    map.fitBounds(boundaryLayer.getBounds(), { padding: [20, 20] });
                }
            }

            const fasilitas = await fetchFasilitasGeoJson();
            facilityLayer = createFacilityLayer(fasilitas);
            facilityLayer.addTo(map);
        } catch (e) {
            console.error('Failed to load landing map:', e);
        }

        // Basemap Switcher on Landing
        const btnStreets = document.getElementById('landing-basemap-streets');
        const btnSatellite = document.getElementById('landing-basemap-satellite');
        if (btnStreets && btnSatellite) {
            btnStreets.addEventListener('click', () => {
                switchBasemap(map, 'streets');
                btnStreets.className = 'px-3 py-1 rounded-xl text-xs font-bold bg-[#0284C7] text-white transition-colors';
                btnSatellite.className = 'px-3 py-1 rounded-xl text-xs font-bold text-gray-600 hover:bg-gray-100 transition-colors';
            });
            btnSatellite.addEventListener('click', () => {
                switchBasemap(map, 'satellite');
                btnSatellite.className = 'px-3 py-1 rounded-xl text-xs font-bold bg-[#0284C7] text-white transition-colors';
                btnStreets.className = 'px-3 py-1 rounded-xl text-xs font-bold text-gray-600 hover:bg-gray-100 transition-colors';
            });
        }

        // Fit Bounds Button on Landing
        const btnFit = document.getElementById('landing-fit-bounds-btn');
        if (btnFit) {
            btnFit.addEventListener('click', () => {
                if (boundaryLayer) {
                    map.fitBounds(boundaryLayer.getBounds(), { padding: [20, 20] });
                } else {
                    map.setView([lat, lng], 15);
                }
            });
        }

        // Category Filter Pills on Landing
        const catButtons = document.querySelectorAll('.landing-cat-btn');
        catButtons.forEach(btn => {
            btn.addEventListener('click', async () => {
                catButtons.forEach(b => {
                    b.classList.remove('bg-[#0284C7]', 'text-white', 'shadow-xs');
                    b.classList.add('bg-white', 'text-gray-700');
                });
                btn.classList.add('bg-[#0284C7]', 'text-white', 'shadow-xs');
                btn.classList.remove('bg-white', 'text-gray-700');

                const catId = btn.dataset.landingCategory;
                const params = catId === 'all' ? {} : { kategori_id: catId };

                try {
                    if (facilityLayer) {
                        map.removeLayer(facilityLayer);
                    }
                    const filteredData = await fetchFasilitasGeoJson(params);
                    facilityLayer = createFacilityLayer(filteredData);
                    facilityLayer.addTo(map);

                    if (filteredData && filteredData.features && filteredData.features.length > 0) {
                        const coords = filteredData.features.map(f => [f.geometry.coordinates[1], f.geometry.coordinates[0]]);
                        if (coords.length > 1) {
                            map.fitBounds(coords, { padding: [40, 40], maxZoom: 17 });
                        } else if (coords.length === 1) {
                            map.flyTo(coords[0], 16);
                        }
                    }
                } catch (err) {
                    console.error('Failed to filter facilities on landing map:', err);
                }
            });
        });
    }
});
