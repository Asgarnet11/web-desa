export async function fetchBatasWilayah(wilayahId = null) {
    const url = wilayahId ? `/api/geojson/batas/${wilayahId}` : '/api/geojson/batas';
    const response = await fetch(url, { headers: { 'Accept': 'application/json' } });
    if (!response.ok) throw new Error('Gagal memuat data batas wilayah');
    return await response.json();
}

export async function fetchFasilitasGeoJson(params = {}) {
    const query = new URLSearchParams(params).toString();
    const url = `/api/geojson/fasilitas${query ? '?' + query : ''}`;
    const response = await fetch(url, { headers: { 'Accept': 'application/json' } });
    if (!response.ok) throw new Error('Gagal memuat data fasilitas');
    return await response.json();
}

export async function fetchChoroplethGeoJson(wilayahId, indikator = 'penduduk') {
    const url = `/api/geojson/choropleth/${wilayahId}?indikator=${indikator}`;
    const response = await fetch(url, { headers: { 'Accept': 'application/json' } });
    if (!response.ok) throw new Error('Gagal memuat data tematik');
    return await response.json();
}

