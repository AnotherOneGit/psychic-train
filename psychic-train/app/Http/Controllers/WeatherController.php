<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Application|Factory|View|\Illuminate\Http\Client\Response
     */
    public function index(Request $request)
    {

        $url = 'http://api.weatherapi.com/v1/history.json?key=156fe4fdc4df412e98d84129200111&q=Moscow&dt=' . Carbon::today() . '&lang=ru&';

        if ($request->has('date')) {
            $url = 'http://api.weatherapi.com/v1/history.json?key=156fe4fdc4df412e98d84129200111&q=Moscow&dt=' . $request->date . '&lang=ru&';
        }

        $response =
            Cache::rememberForever('response',  function () use ($url) {
            return
                json_decode(collect(Http::get($url)->json()), true, 512, JSON_THROW_ON_ERROR);
        });

        $name =
            Cache::rememberForever('name', function () use ($response) {
            return
                $response['location']['name'];
        });

        $condition =
            Cache::rememberForever('condition', function () use ($response) {
            return
                $response['forecast']['forecastday'][0]['day']['condition'];
        });

        $maxwind_kph = Cache::rememberForever('maxwind_kph', function () use ($response) {
            return $response['forecast']['forecastday'][0]['day']['maxwind_kph'];
        });

        $date = Cache::rememberForever('date', function () use ($response) {
        return $response['forecast']['forecastday'][0]['date'];
    });

        $avgtemp_c = Cache::rememberForever('$avgtemp_c', function () use ($response) {
            return $response['forecast']['forecastday'][0]['day']['avgtemp_c'];
        });

        return view('weather', compact('response','avgtemp_c', 'condition', 'date', 'maxwind_kph', 'name'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
