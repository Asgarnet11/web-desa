import L from 'leaflet';

export function initMap(containerId = 'map', options = {}) {
    const defaultCenter = options.center || [-6.8872, 107.5765];
    const defaultZoom = options.zoom || 15;

    const map = L.map(containerId, {
        zoomControl: false,
        attributionControl: true,
        ...options
    }).setView(defaultCenter, defaultZoom);

    // Subtle desaturated CartoDB Positron / OSM style
    const tileLayer = L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>',
        subdomains: 'abcd',
        maxZoom: 20
    }).addTo(map);

    // Zoom controls with Solarpunk rounded styling
    L.control.zoom({
        position: 'bottomright'
    }).addTo(map);

    return map;
}
