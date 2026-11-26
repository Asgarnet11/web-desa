<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Wilayah;
use App\Services\GeoJsonService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GeoJsonController extends Controller
{
    public function __construct(
        protected GeoJsonService $geoJsonService
    ) {}

    public function batas(?int $wilayahId = null): JsonResponse
    {
        $wilayah = $wilayahId
            ? Wilayah::find($wilayahId)
            : Wilayah::whereNotNull('batas')->first();

        if (! $wilayah) {
            return response()->json(['message' => 'Data batas wilayah tidak ditemukan'], 404);
        }

        $feature = $this->geoJsonService->getBatasWilayahFeature($wilayah);

        return response()->json($feature);
    }

    public function fasilitas(Request $request): JsonResponse
    {
        $wilayahId = $request->get('wilayah_id');
        $kategoriId = $request->get('kategori_id');

        $featureCollection = $this->geoJsonService->getFasilitasFeatureCollection($wilayahId, $kategoriId);

        return response()->json($featureCollection);
    }

    public function umkm(Request $request): JsonResponse
    {
        $wilayahId = $request->get('wilayah_id');
        $kategori = $request->get('kategori');

        $featureCollection = $this->geoJsonService->getUmkmFeatureCollection($wilayahId, $kategori);

        return response()->json($featureCollection);
    }

    public function choropleth(int $wilayahId, Request $request): JsonResponse
    {
        $indikator = $request->get('indikator', 'penduduk');
        $featureCollection = $this->geoJsonService->getChoroplethData($wilayahId, $indikator);

        return response()->json($featureCollection);
    }
}
