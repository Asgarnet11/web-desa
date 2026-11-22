import { initMap, switchBasemap, locateUser } from './modules/peta/init-map';
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
        zoom: 15,
        scrollWheelZoom: true
    });

    let boundaryLayer = null;
    let facilityLayerGroup = null;
    let allMarkers = [];
    const markersById = {};

    let currentSelectedCategory = 'all';
    let currentSearchTerm = '';

    try {
        // 1. Load Batas Wilayah GeoJSON
        const boundaryGeoJson = await fetchBatasWilayah();
        if (boundaryGeoJson) {
            boundaryLayer = createBoundaryLayer(boundaryGeoJson);
            if (boundaryLayer) {
                boundaryLayer.addTo(map);
                map.fitBounds(boundaryLayer.getBounds(), { padding: [30, 30] });
            }
        }

        // 2. Load Fasilitas GeoJSON
        const fasilitasGeoJson = await fetchFasilitasGeoJson();
        if (fasilitasGeoJson && fasilitasGeoJson.features) {
            facilityLayerGroup = createFacilityLayer(fasilitasGeoJson);
            facilityLayerGroup.addTo(map);

            facilityLayerGroup.eachLayer(marker => {
                if (marker.facilityId) {
                    markersById[marker.facilityId] = marker;
                    allMarkers.push(marker);
                }
            });
        }
    } catch (err) {
        console.error('Error loading map data:', err);
    }

    // 3. Basemap Switcher Controls
    const basemapButtons = document.querySelectorAll('.basemap-btn');
    basemapButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            const basemapKey = btn.dataset.basemap;
            switchBasemap(map, basemapKey);

            basemapButtons.forEach(b => {
                b.classList.remove('bg-[#0284C7]', 'text-white', 'shadow-xs');
                b.classList.add('text-gray-600', 'hover:bg-gray-100');
            });
            btn.classList.add('bg-[#0284C7]', 'text-white', 'shadow-xs');
            btn.classList.remove('text-gray-600', 'hover:bg-gray-100');
        });
    });

    // 4. Toggle Boundary Layer Button
    const toggleBoundaryBtn = document.getElementById('toggle-boundary-btn');
    let isBoundaryVisible = true;
    if (toggleBoundaryBtn && boundaryLayer) {
        toggleBoundaryBtn.addEventListener('click', () => {
            if (isBoundaryVisible) {
                map.removeLayer(boundaryLayer);
                isBoundaryVisible = false;
                toggleBoundaryBtn.classList.remove('text-emerald-800', 'bg-emerald-50');
                toggleBoundaryBtn.classList.add('text-gray-400', 'bg-gray-100');
            } else {
                boundaryLayer.addTo(map);
                isBoundaryVisible = true;
                toggleBoundaryBtn.classList.add('text-emerald-800', 'bg-emerald-50');
                toggleBoundaryBtn.classList.remove('text-gray-400', 'bg-gray-100');
            }
        });
    }

    // 5. Locate Me (GPS) Button
    const locateMeBtn = document.getElementById('locate-me-btn');
    if (locateMeBtn) {
        locateMeBtn.addEventListener('click', () => {
            locateMeBtn.classList.add('animate-spin');
            locateUser(
                map,
                () => {
                    locateMeBtn.classList.remove('animate-spin');
                },
                (errMessage) => {
                    locateMeBtn.classList.remove('animate-spin');
                    alert(errMessage || 'Gagal mendeteksi lokasi GPS');
                }
            );
        });
    }

    // 6. Fit Bounds / Re-center Button
    const fitBoundsBtn = document.getElementById('fit-bounds-btn');
    if (fitBoundsBtn) {
        fitBoundsBtn.addEventListener('click', () => {
            if (boundaryLayer) {
                map.fitBounds(boundaryLayer.getBounds(), { padding: [30, 30] });
            } else {
                map.setView([initialLat, initialLng], 15);
            }
        });
    }

    // 7. Fullscreen Toggle Button
    const fullscreenBtn = document.getElementById('fullscreen-map-btn');
    const mapFrame = document.getElementById('map-container-frame');
    if (fullscreenBtn && mapFrame) {
        fullscreenBtn.addEventListener('click', () => {
            if (!document.fullscreenElement) {
                mapFrame.requestFullscreen().catch(err => {
                    console.warn('Error attempting to enable fullscreen:', err);
                });
            } else {
                document.exitFullscreen();
            }
        });

        document.addEventListener('fullscreenchange', () => {
            setTimeout(() => {
                map.invalidateSize();
            }, 200);
        });
    }

    // 8. Filter Logic: Search + Category
    const searchInput = document.getElementById('facility-search-input');
    const clearSearchBtn = document.getElementById('clear-search-btn');
    const categoryButtons = document.querySelectorAll('.category-filter-btn');
    const facilityCards = document.querySelectorAll('.facility-card');
    const countBadge = document.getElementById('facility-count-badge');
    const emptyState = document.getElementById('facility-empty-state');
    const resetFilterBtn = document.getElementById('reset-filter-btn');

    function applyFilters() {
        const query = currentSearchTerm.trim().toLowerCase();
        let visibleCount = 0;
        const visibleMarkers = [];

        facilityCards.forEach(card => {
            const cardCatId = card.dataset.categoryId;
            const cardName = card.dataset.name || '';
            const cardAddr = card.dataset.address || '';
            const cardFacId = card.dataset.facilityId;
            const marker = markersById[cardFacId];

            const matchesCategory = (currentSelectedCategory === 'all' || cardCatId === currentSelectedCategory);
            const matchesSearch = query === '' || cardName.includes(query) || cardAddr.includes(query);

            if (matchesCategory && matchesSearch) {
                card.classList.remove('hidden');
                visibleCount++;
                if (marker) {
                    if (!map.hasLayer(marker)) {
                        marker.addTo(map);
                    }
                    visibleMarkers.push(marker);
                }
            } else {
                card.classList.add('hidden');
                if (marker && map.hasLayer(marker)) {
                    map.removeLayer(marker);
                }
            }
        });

        // Update count badge
        if (countBadge) {
            countBadge.textContent = `${visibleCount} Fasilitas`;
        }

        // Show/hide empty state
        if (emptyState) {
            if (visibleCount === 0) {
                emptyState.classList.remove('hidden');
            } else {
                emptyState.classList.add('hidden');
            }
        }

        // Adjust map bounds if filtered down to a subset
        if (visibleMarkers.length > 0 && visibleMarkers.length < allMarkers.length) {
            const group = L.featureGroup(visibleMarkers);
            map.fitBounds(group.getBounds(), { padding: [50, 50], maxZoom: 17 });
        }
    }

    if (searchInput) {
        searchInput.addEventListener('input', (e) => {
            currentSearchTerm = e.target.value;
            if (clearSearchBtn) {
                clearSearchBtn.classList.toggle('hidden', currentSearchTerm.length === 0);
            }
            applyFilters();
        });
    }

    if (clearSearchBtn) {
        clearSearchBtn.addEventListener('click', () => {
            searchInput.value = '';
            currentSearchTerm = '';
            clearSearchBtn.classList.add('hidden');
            applyFilters();
            searchInput.focus();
        });
    }

    categoryButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            currentSelectedCategory = btn.dataset.categoryFilter;

            categoryButtons.forEach(b => {
                b.classList.remove('bg-[#0284C7]', 'text-white', 'shadow-xs');
                b.classList.add('bg-gray-100', 'text-gray-700');
            });
            btn.classList.add('bg-[#0284C7]', 'text-white', 'shadow-xs');
            btn.classList.remove('bg-gray-100', 'text-gray-700');

            applyFilters();
        });
    });

    if (resetFilterBtn) {
        resetFilterBtn.addEventListener('click', () => {
            if (searchInput) searchInput.value = '';
            currentSearchTerm = '';
            currentSelectedCategory = 'all';

            categoryButtons.forEach(b => {
                const isAll = b.dataset.categoryFilter === 'all';
                b.classList.toggle('bg-[#0284C7]', isAll);
                b.classList.toggle('text-white', isAll);
                b.classList.toggle('bg-gray-100', !isAll);
                b.classList.toggle('text-gray-700', !isAll);
            });

            if (clearSearchBtn) clearSearchBtn.classList.add('hidden');
            applyFilters();

            if (boundaryLayer) {
                map.fitBounds(boundaryLayer.getBounds(), { padding: [30, 30] });
            }
        });
    }

    // 9. Card Interactions: Focus Marker & Open Popup on Click
    facilityCards.forEach(card => {
        card.addEventListener('click', () => {
            const facId = card.dataset.facilityId;
            const lat = parseFloat(card.dataset.lat);
            const lng = parseFloat(card.dataset.lng);
            const marker = markersById[facId];

            if (marker && !isNaN(lat) && !isNaN(lng)) {
                // Ensure marker is on map
                if (!map.hasLayer(marker)) {
                    marker.addTo(map);
                }

                // Fly to coordinate and open popup
                map.flyTo([lat, lng], 17, { duration: 1 });
                setTimeout(() => {
                    marker.openPopup();
                }, 800);

                // On mobile screens, scroll slightly or adjust view
                if (window.innerWidth < 1024) {
                    const mapFrameEl = document.getElementById('map-container-frame');
                    if (mapFrameEl) {
                        mapFrameEl.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    }
                }
            }
        });
    });

    // 10. Mobile Drawer Toggle Button
    const mobileDrawerToggleBtn = document.getElementById('mobile-drawer-toggle-btn');
    const sidebar = document.getElementById('facility-sidebar');
    if (mobileDrawerToggleBtn && sidebar) {
        mobileDrawerToggleBtn.addEventListener('click', () => {
            sidebar.scrollIntoView({ behavior: 'smooth', block: 'start' });
        });
    }
});
