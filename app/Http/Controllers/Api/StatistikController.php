<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\StatistikService;
use Illuminate\Http\JsonResponse;

class StatistikController extends Controller
{
    public function __construct(
        protected StatistikService $statistikService
    ) {}

    public function show(int $wilayahId): JsonResponse
    {
        $data = $this->statistikService->getRingkasanWilayah($wilayahId);

        return response()->json($data);
    }
}
