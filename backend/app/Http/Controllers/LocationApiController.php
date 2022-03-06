<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;

class LocationApiController extends Controller
{
    /**
     * Filter Locations within a certain radius of a given lat/lng
     *
     * @return Array of Locations
     */
    private function filterByRadius($locations, Request $request) {
        return $locations->filter(function ($location) use ($request) {
            $r = (int)$request->radius;
            $x = (float)$location->longitude * 69;
            $a = (float)$request->longitude * 69;
            $y = (float)$location->latitude * 54.6;
            $b = (float)$request->latitude * 54.6;

            return ($x - $a) ** 2 + ($y - $b) ** 2 <= $r ** 2 ? true : false;
        })->values();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $code = 200;
        $output = [];

        try {
            $request->validate([
                "city" => "string",
                "latitude" => "required_with:radius|numeric|min:-90|max:90",
                "longitude" => "required_with:radius|numeric|min:-180|max:180",
                "radius" => "prohibits:city|integer|min:1|max:100",
            ]);

            $city = ucWords($request->city);
            $onlyCities = $request->only_cities;

            if ($onlyCities) {
                $output = Location::select("city")
                ->groupBy("city")
                ->orderBy("city")
                ->pluck("city");
            } else {
                $output = Location::when($city, fn ($query) => $query->where("city", $city))
                ->orderBy("name")
                ->get();

                if ($request->radius) {
                    $output = $this->filterByRadius($output, $request);
                }
            }
        } catch (\Throwable $error) {
            $code = 400;
            $output["error"] = "Invalid city: $request->city";
            $output = $error;
        }

        return response($output, $code);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $output = Location::find($id);
        $code = $output ? 200 : 404;

        return response($output, $code);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
