<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    Booking,
    Course,
    Student
};

class StudentApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $code = 200;
        $output = Student::orderBy("firstName")->orderBy("lastName")->get();

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
        $output = Student::find($id);

        if ($output) {
            $with = ["course", "location", "trainer"];
            $output->bookings = Booking::with($with)
            ->whereJsonContains("students", $output->id)
            ->get();
        }

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
