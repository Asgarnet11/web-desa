import L from 'leaflet';

export const baseTileConfigs = {
    streets: {
        url: 'https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png',
        options: {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>',
            subdomains: 'abcd',
            maxZoom: 20
        }
    },
    satellite: {
        url: 'https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}',
        options: {
            attribution: 'Tiles &copy; Esri &mdash; Source: Esri, i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP, UPR-EGP, and the GIS User Community',
            maxZoom: 19
        }
    },
    topo: {
        url: 'https://{s}.tile.opentopomap.org/{z}/{x}/{y}.png',
        options: {
            attribution: 'Map data: &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, <a href="http://viewfinderpanoramas.org">SRTM</a> | Map style: &copy; <a href="https://opentopomap.org">OpenTopoMap</a>',
            maxZoom: 17
        }
    }
};

export function initMap(containerId = 'map', options = {}) {
    const defaultCenter = options.center || [-4.124444, 122.440278];
    const defaultZoom = options.zoom || 15;

    const map = L.map(containerId, {
        zoomControl: false,
        attributionControl: true,
        scrollWheelZoom: options.scrollWheelZoom !== undefined ? options.scrollWheelZoom : true,
        ...options
    }).setView(defaultCenter, defaultZoom);

    // Initial base tile layer (streets by default)
    const initialTile = L.tileLayer(baseTileConfigs.streets.url, baseTileConfigs.streets.options).addTo(map);
    map._currentBaseTile = initialTile;
    map._currentBaseKey = 'streets';

    // Scale control (metric in meters/kilometers)
    L.control.scale({
        metric: true,
        imperial: false,
        position: 'bottomleft'
    }).addTo(map);

    // Zoom controls at bottom-right with clean styling
    L.control.zoom({
        position: 'bottomright'
    }).addTo(map);

    return map;
}

export function switchBasemap(map, key = 'streets') {
    if (!map || !baseTileConfigs[key]) return;
    if (map._currentBaseKey === key) return;

    if (map._currentBaseTile) {
        map.removeLayer(map._currentBaseTile);
    }

    const newTile = L.tileLayer(baseTileConfigs[key].url, baseTileConfigs[key].options).addTo(map);
    if (newTile.bringToBack) {
        newTile.bringToBack();
    }
    map._currentBaseTile = newTile;
    map._currentBaseKey = key;
}

let userLocationMarker = null;
let userLocationCircle = null;

export function locateUser(map, onSuccess = null, onError = null) {
    if (!navigator.geolocation) {
        if (onError) onError('Perangkat tidak mendukung geolokasi');
        return;
    }

    navigator.geolocation.getCurrentPosition(
        (pos) => {
            const { latitude, longitude, accuracy } = pos.coords;

            if (userLocationMarker) map.removeLayer(userLocationMarker);
            if (userLocationCircle) map.removeLayer(userLocationCircle);

            // Glowing blue user location icon
            const userIcon = L.divIcon({
                className: 'user-gps-marker',
                html: `
                    <div style="
                        width: 18px;
                        height: 18px;
                        border-radius: 50%;
                        background-color: #0284C7;
                        border: 3px solid #FFFFFF;
                        box-shadow: 0 0 12px rgba(2, 132, 199, 0.8);
                        position: relative;
                    ">
                        <span style="
                            position: absolute;
                            inset: -8px;
                            border-radius: 50%;
                            background-color: rgba(2, 132, 199, 0.35);
                            animation: ping 1.5s cubic-bezier(0, 0, 0.2, 1) infinite;
                        "></span>
                    </div>
                `,
                iconSize: [18, 18],
                iconAnchor: [9, 9]
            });

            userLocationCircle = L.circle([latitude, longitude], {
                radius: accuracy || 50,
                color: '#0284C7',
                fillColor: '#0284C7',
                fillOpacity: 0.12,
                weight: 1.5
            }).addTo(map);

            userLocationMarker = L.marker([latitude, longitude], { icon: userIcon })
                .bindTooltip('<b>Lokasi Anda Saat Ini</b>', { permanent: false, direction: 'top' })
                .addTo(map);

            map.flyTo([latitude, longitude], 16, { duration: 1.2 });
            if (onSuccess) onSuccess({ latitude, longitude });
        },
        (err) => {
            console.warn('Geolocation error:', err);
            if (onError) onError('Gagal mendeteksi lokasi GPS atau izin ditolak');
        },
        { enableHighAccuracy: true, timeout: 8000 }
    );
}
