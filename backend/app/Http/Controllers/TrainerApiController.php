<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    Booking,
    Course,
    Trainer
};

class TrainerApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $code = 200;
        $course = null;
        $output = [];

        try {
            $request->validate(["course_id" => "integer|exists:courses,id"]);

            $course = Course::find($request->course_id);

            $output = Trainer::when($course, function ($query) use ($course) {
                $query->where("level", ">=", $course->level)
                    ->whereJsonContains("competencies", $course->topic);
                })
                ->orderBy("firstName")
                ->orderBy("lastName")
                ->get();
        } catch (\Throwable $th) {
            $code = 400;
            $output["error"] = "Invalid Course ID: $request->course_id";
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
        $output = Trainer::find($id);

        if ($output) {
            $with = ["course", "location"];
            $output->bookings = Booking::with($with)
            ->where("trainer_id", $output->id)
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
