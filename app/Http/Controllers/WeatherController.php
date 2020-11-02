<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Application|Factory|View|\Illuminate\Http\Client\Response
     * @throws \JsonException
     */
    public function index(Request $request)
    {
        $url = 'http://api.weatherapi.com/v1/history.json?key=156fe4fdc4df412e98d84129200111&q=Moscow&dt='.Carbon::today().'&lang=ru&';

        if ($request->has('date')) {
            $url = 'http://api.weatherapi.com/v1/history.json?key=156fe4fdc4df412e98d84129200111&q=Moscow&dt='.$request->date.'&lang=ru&';
        }

        $response = json_decode(collect(Http::get($url)->json()), true, 512, JSON_THROW_ON_ERROR);
        dump($response);
        $maxwind_kph = $response['forecast']['forecastday'][0]['day']['maxwind_kph'];
        $name = $response['location']['name'];
        $date = $response['forecast']['forecastday'][0]['date'];
        $condition = $response['forecast']['forecastday'][0]['day']['condition'];
        $avgtemp_c = $response['forecast']['forecastday'][0]['day']['avgtemp_c'];
        return view('weather', compact('response', 'avgtemp_c', 'condition', 'date', 'name', 'maxwind_kph'));
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
     * @param \Illuminate\Http\Request $request
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
     * @param \Illuminate\Http\Request $request
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
