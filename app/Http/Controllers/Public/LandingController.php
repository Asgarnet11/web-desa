<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Services\LandingPageData;
use Illuminate\View\View;

class LandingController extends Controller
{
    public function __construct(
        protected LandingPageData $landingPageData
    ) {}

    public function index(): View
    {
        $data = $this->landingPageData->get();

        return view('pages.landing.index', compact('data'));
    }
}

