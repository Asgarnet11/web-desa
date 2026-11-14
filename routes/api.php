<?php

use App\Http\Controllers\Api\GeoJsonController;
use App\Http\Controllers\Api\StatistikController;
use Illuminate\Support\Facades\Route;

Route::middleware('throttle:60,1')->group(function () {
    Route::get('/geojson/batas/{wilayah?}', [GeoJsonController::class, 'batas'])->name('api.geojson.batas');
    Route::get('/geojson/fasilitas', [GeoJsonController::class, 'fasilitas'])->name('api.geojson.fasilitas');
    Route::get('/geojson/choropleth/{wilayah}', [GeoJsonController::class, 'choropleth'])->name('api.geojson.choropleth');

    Route::get('/statistik/{wilayah}', [StatistikController::class, 'show'])->name('api.statistik.show');
});
