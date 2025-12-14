<?php

namespace App\Http\Controllers;

use App\Services\WeatherService;

class EnvironmentalController extends Controller
{
    protected $weatherService;

    public function __construct(WeatherService $weatherService)
    {
        $this->weatherService = $weatherService;
    }

    public function index()
    {
        $weather = $this->weatherService->getWeather();

        return view('environmental', compact('weather'));
    }

    public function api()
    {
        return $this->weatherService->getWeather();
    }
}
