import { initMap, switchBasemap, locateUser } from './modules/peta/init-map';
import { fetchBatasWilayah, fetchFasilitasGeoJson, fetchUmkmGeoJson } from './modules/peta/api-client';
import { createBoundaryLayer } from './modules/peta/layers/boundary-layer';
import { createFacilityLayer } from './modules/peta/layers/facility-layer';
import { createUmkmLayer } from './modules/peta/layers/umkm-layer';

document.addEventListener('DOMContentLoaded', async () => {
    const mapElement = document.getElementById('map');
    if (!mapElement) return;

    const initialLat = parseFloat(mapElement.dataset.lat) || -4.124444;
    const initialLng = parseFloat(mapElement.dataset.lng) || 122.440278;

    const map = initMap('map', {
        center: [initialLat, initialLng],
        zoom: 15,
        scrollWheelZoom: true
    });

    let boundaryLayer = null;
    let facilityLayerGroup = null;
    let umkmLayerGroup = null;
    let isUmkmVisible = true;
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

        // 2b. Load UMKM GeoJSON
        const umkmGeoJson = await fetchUmkmGeoJson();
        if (umkmGeoJson && umkmGeoJson.features) {
            umkmLayerGroup = createUmkmLayer(umkmGeoJson);
            umkmLayerGroup.addTo(map);

            umkmLayerGroup.eachLayer(marker => {
                if (marker.umkmId) {
                    markersById['umkm-' + marker.umkmId] = marker;
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

    // 4b. Toggle UMKM Layer Button
    const toggleUmkmBtn = document.getElementById('toggle-umkm-btn');
    if (toggleUmkmBtn) {
        toggleUmkmBtn.addEventListener('click', () => {
            if (!umkmLayerGroup) return;
            if (isUmkmVisible) {
                map.removeLayer(umkmLayerGroup);
                isUmkmVisible = false;
                toggleUmkmBtn.classList.remove('text-orange-700', 'bg-orange-50', 'border-orange-200');
                toggleUmkmBtn.classList.add('text-gray-400', 'bg-gray-100', 'border-gray-200');
            } else {
                umkmLayerGroup.addTo(map);
                isUmkmVisible = true;
                toggleUmkmBtn.classList.add('text-orange-700', 'bg-orange-50', 'border-orange-200');
                toggleUmkmBtn.classList.remove('text-gray-400', 'bg-gray-100', 'border-gray-200');
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

    // 5b. Nearby Radius Filtering & Distance Sorting
    const nearbyFilterBtn = document.getElementById('nearby-filter-btn');
    const nearbyRadiusBar = document.getElementById('nearby-radius-bar');
    const closeNearbyBtn = document.getElementById('close-nearby-btn');
    const radiusOptions = document.querySelectorAll('.nearby-radius-option');

    let isNearbyActive = false;
    let userCoords = null;
    let selectedRadiusMeters = 1000;
    let nearbyCircle = null;

    function getDistanceMeters(lat1, lon1, lat2, lon2) {
        const R = 6371e3;
        const phi1 = (lat1 * Math.PI) / 180;
        const phi2 = (lat2 * Math.PI) / 180;
        const deltaPhi = ((lat2 - lat1) * Math.PI) / 180;
        const deltaLambda = ((lon2 - lon1) * Math.PI) / 180;

        const a = Math.sin(deltaPhi / 2) * Math.sin(deltaPhi / 2) +
                  Math.cos(phi1) * Math.cos(phi2) *
                  Math.sin(deltaLambda / 2) * Math.sin(deltaLambda / 2);
        const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
        return Math.round(R * c);
    }

    function formatDistance(meters) {
        if (meters < 1000) {
            return `${meters} m`;
        }
        return `${(meters / 1000).toFixed(1)} km`;
    }

    function updateNearbyView() {
        if (!userCoords) return;

        if (nearbyCircle) {
            map.removeLayer(nearbyCircle);
        }
        nearbyCircle = L.circle([userCoords.latitude, userCoords.longitude], {
            radius: selectedRadiusMeters,
            color: '#10B981',
            fillColor: '#10B981',
            fillOpacity: 0.12,
            weight: 2,
            dashArray: '5, 5'
        }).addTo(map);

        map.fitBounds(nearbyCircle.getBounds(), { padding: [40, 40], maxZoom: 17 });

        // Update facility cards with distances and radius filter
        const facilityCardsArray = Array.from(facilityCards);
        facilityCardsArray.forEach(card => {
            const lat = parseFloat(card.dataset.lat);
            const lng = parseFloat(card.dataset.lng);
            if (!isNaN(lat) && !isNaN(lng)) {
                const dist = getDistanceMeters(userCoords.latitude, userCoords.longitude, lat, lng);
                card.dataset.distance = dist;

                let badge = card.querySelector('.distance-badge');
                if (!badge) {
                    badge = document.createElement('span');
                    badge.className = 'distance-badge text-[10px] font-bold text-emerald-800 bg-emerald-50 border border-emerald-200 px-2 py-0.5 rounded-full inline-flex items-center gap-1 mt-1';
                    const titleEl = card.querySelector('h3');
                    if (titleEl && titleEl.parentNode) {
                        titleEl.parentNode.insertBefore(badge, titleEl.nextSibling);
                    }
                }
                badge.innerHTML = `📍 ${formatDistance(dist)}`;

                if (dist <= selectedRadiusMeters) {
                    card.classList.remove('hidden-by-radius');
                } else {
                    card.classList.add('hidden-by-radius');
                }
            }
        });

        if (facilityListContainer) {
            facilityCardsArray
                .sort((a, b) => (parseFloat(a.dataset.distance) || 999999) - (parseFloat(b.dataset.distance) || 999999))
                .forEach(card => facilityListContainer.appendChild(card));
        }

        // Update UMKM cards with distances
        const umkmCards = document.querySelectorAll('.umkm-card');
        const umkmCardsArray = Array.from(umkmCards);
        umkmCardsArray.forEach(card => {
            const lat = parseFloat(card.dataset.lat);
            const lng = parseFloat(card.dataset.lng);
            if (!isNaN(lat) && !isNaN(lng)) {
                const dist = getDistanceMeters(userCoords.latitude, userCoords.longitude, lat, lng);
                card.dataset.distance = dist;

                let badge = card.querySelector('.distance-badge');
                if (!badge) {
                    badge = document.createElement('span');
                    badge.className = 'distance-badge text-[10px] font-bold text-orange-800 bg-orange-50 border border-orange-200 px-2 py-0.5 rounded-full inline-flex items-center gap-1 mt-1';
                    const titleEl = card.querySelector('h3');
                    if (titleEl && titleEl.parentNode) {
                        titleEl.parentNode.insertBefore(badge, titleEl.nextSibling);
                    }
                }
                badge.innerHTML = `📍 ${formatDistance(dist)}`;

                if (dist <= selectedRadiusMeters) {
                    card.classList.remove('hidden-by-radius');
                } else {
                    card.classList.add('hidden-by-radius');
                }
            }
        });

        if (umkmListContainer) {
            umkmCardsArray
                .sort((a, b) => (parseFloat(a.dataset.distance) || 999999) - (parseFloat(b.dataset.distance) || 999999))
                .forEach(card => umkmListContainer.appendChild(card));
        }

        applyFilters();
    }

    function disableNearbyView() {
        isNearbyActive = false;
        if (nearbyCircle) {
            map.removeLayer(nearbyCircle);
            nearbyCircle = null;
        }
        if (nearbyRadiusBar) {
            nearbyRadiusBar.classList.add('hidden');
            nearbyRadiusBar.classList.remove('flex');
        }
        if (nearbyFilterBtn) {
            nearbyFilterBtn.classList.remove('bg-emerald-600', 'text-white');
            nearbyFilterBtn.classList.add('bg-emerald-50', 'text-emerald-800');
        }

        facilityCards.forEach(card => card.classList.remove('hidden-by-radius'));
        const umkmCards = document.querySelectorAll('.umkm-card');
        umkmCards.forEach(card => card.classList.remove('hidden-by-radius'));

        applyFilters();
    }

    if (nearbyFilterBtn) {
        nearbyFilterBtn.addEventListener('click', () => {
            if (isNearbyActive) {
                disableNearbyView();
                return;
            }

            nearbyFilterBtn.classList.add('animate-pulse');
            locateUser(
                map,
                (coords) => {
                    nearbyFilterBtn.classList.remove('animate-pulse');
                    nearbyFilterBtn.classList.remove('bg-emerald-50', 'text-emerald-800');
                    nearbyFilterBtn.classList.add('bg-emerald-600', 'text-white');
                    userCoords = coords;
                    isNearbyActive = true;
                    if (nearbyRadiusBar) {
                        nearbyRadiusBar.classList.remove('hidden');
                        nearbyRadiusBar.classList.add('flex');
                    }
                    updateNearbyView();
                },
                (errMessage) => {
                    nearbyFilterBtn.classList.remove('animate-pulse');
                    alert(errMessage || 'Gagal mendeteksi lokasi GPS untuk filter sekitar');
                }
            );
        });
    }

    if (closeNearbyBtn) {
        closeNearbyBtn.addEventListener('click', disableNearbyView);
    }

    radiusOptions.forEach(opt => {
        opt.addEventListener('click', () => {
            selectedRadiusMeters = parseInt(opt.dataset.radius, 10);
            radiusOptions.forEach(o => {
                o.classList.remove('bg-emerald-500', 'font-black', 'shadow-xs');
                o.classList.add('bg-emerald-800');
            });
            opt.classList.add('bg-emerald-500', 'font-black', 'shadow-xs');
            opt.classList.remove('bg-emerald-800');
            updateNearbyView();
        });
    });

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
            const matchesRadius = !isNearbyActive || !card.classList.contains('hidden-by-radius');

            if (matchesCategory && matchesSearch && matchesRadius) {
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

    // 9b. UMKM Card Interactions: Focus Marker & Open Popup on Click
    const umkmCards = document.querySelectorAll('.umkm-card');
    umkmCards.forEach(card => {
        card.addEventListener('click', () => {
            const umkmId = card.dataset.umkmId;
            const lat = parseFloat(card.dataset.lat);
            const lng = parseFloat(card.dataset.lng);
            const marker = markersById['umkm-' + umkmId];

            if (marker && !isNaN(lat) && !isNaN(lng)) {
                if (!map.hasLayer(marker)) {
                    marker.addTo(map);
                }

                map.flyTo([lat, lng], 17, { duration: 1 });
                setTimeout(() => {
                    marker.openPopup();
                }, 800);

                if (window.innerWidth < 1024) {
                    const mapFrameEl = document.getElementById('map-container-frame');
                    if (mapFrameEl) {
                        mapFrameEl.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    }
                }
            }
        });
    });

    // 9c. Tab Switcher (Fasilitas vs UMKM)
    const tabFasilitasBtn = document.getElementById('tab-fasilitas-btn');
    const tabUmkmBtn = document.getElementById('tab-umkm-btn');
    const facilityListContainer = document.getElementById('facility-list-container');
    const umkmListContainer = document.getElementById('umkm-list-container');

    if (tabFasilitasBtn && tabUmkmBtn && facilityListContainer && umkmListContainer) {
        tabFasilitasBtn.addEventListener('click', () => {
            tabFasilitasBtn.classList.add('bg-[#0284C7]', 'text-white', 'shadow-xs');
            tabFasilitasBtn.classList.remove('text-gray-600', 'hover:bg-orange-50', 'hover:text-orange-600');

            tabUmkmBtn.classList.remove('bg-orange-600', 'text-white', 'shadow-xs');
            tabUmkmBtn.classList.add('text-gray-600', 'hover:bg-orange-50', 'hover:text-orange-600');

            facilityListContainer.classList.remove('hidden');
            umkmListContainer.classList.add('hidden');
        });

        tabUmkmBtn.addEventListener('click', () => {
            tabUmkmBtn.classList.add('bg-orange-600', 'text-white', 'shadow-xs');
            tabUmkmBtn.classList.remove('text-gray-600', 'hover:bg-orange-50', 'hover:text-orange-600');

            tabFasilitasBtn.classList.remove('bg-[#0284C7]', 'text-white', 'shadow-xs');
            tabFasilitasBtn.classList.add('text-gray-600', 'hover:bg-orange-50', 'hover:text-orange-600');

            facilityListContainer.classList.add('hidden');
            umkmListContainer.classList.remove('hidden');

            // If UMKM layer is currently hidden on map, turn it on
            if (!isUmkmVisible && umkmLayerGroup) {
                umkmLayerGroup.addTo(map);
                isUmkmVisible = true;
                if (toggleUmkmBtn) {
                    toggleUmkmBtn.classList.add('text-orange-700', 'bg-orange-50', 'border-orange-200');
                    toggleUmkmBtn.classList.remove('text-gray-400', 'bg-gray-100', 'border-gray-200');
                }
            }
        });
    }

    // 10. Mobile Drawer Toggle Button
    const mobileDrawerToggleBtn = document.getElementById('mobile-drawer-toggle-btn');
    const sidebar = document.getElementById('facility-sidebar');
    if (mobileDrawerToggleBtn && sidebar) {
        mobileDrawerToggleBtn.addEventListener('click', () => {
            sidebar.scrollIntoView({ behavior: 'smooth', block: 'start' });
        });
    }
});
