<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Illuminate\Validation\ValidationException;
use Carbon\Carbon;
use App\Models\{
    Booking,
    Course,
    Location,
    Student,
    Trainer
};

class BookingApiController extends Controller
{

    /**
     * Parses caught errors
     *
     * @return associated Array / String
     */
    private function handleError(\Throwable $error) {
        $code = 400;

        if ($error instanceof ValidationException) {
            $message = $error->errors();
        } else if ($error instanceof \Exception) {
            $message = json_decode($error->getMessage());
        } else {
            $message = $error->getMessage();
            $code = $error->getCode();
        }

        return [$message, $code];
    }

    /**
     * Validates Booking request form
     *
     * @return associated Array of form fields
     * @throws ValidationException;
     */
    private function validateBooking(Request $request) {
        // throws ValidationException if not valid
        $form = $request->validate([
            "course_id" => "required|integer|exists:courses,id",
            "location_id" => "required|integer|exists:locations,id",
            "trainer_id" => "required|integer|exists:trainers,id",
            "student_ids" => "required|json",
            "start" => "required|date|after_or_equal:today",
            "end" => "required|date|after_or_equal:start",
            "certificate_needed" => "required|boolean",
            "comments" => "string|nullable"
        ]);

        // additional validation for Trainer
        $this->validateTrainer($request->course_id, $request->location_id, $request->trainer_id,);

        // additional validation for student ID list
        $form["students"] = $this->validateStudentIds($request->student_ids);

        // parse dates
        $form["start"] = Carbon::create($form["start"]);
        $form["end"] = Carbon::create($form["end"]);

        return $form;
    }

    /**
     * Validates student ID list
     *
     * @return Array of Student IDs
     * @throws ValidationException;
     */
    private function validateStudentIds(String $studentIds) {
        // throw error in a consistent way similar to ValidationException
        $error = (object) ["student_ids" => []];

        try {
            $students = json_decode($studentIds);

            if (!is_array($students)) {
                throw new \Exception("student_ids is not a valid array");
            }

            if (!count($students)) {
                throw new \Exception("student_ids is an empty array");
            }

            $students = array_unique($students);

            foreach ($students as $id) {
                if (!is_integer($id)) {
                    throw new \Exception("Student ID not an integer: $id");
                }
                if (!Student::find($id)) {
                    throw new \Exception("Invalid Student ID: $id");
                }
            }

            return $students;
        } catch (\Exception $err) {
            $error->student_ids = $err->getMessage();
            throw new \Exception(json_encode($error));
        }
    }

    function validateTrainer($courseId, $locationId, $trainerId) {
        $course = Course::find($courseId);
        $error = (object) ["trainer_id" => []];
        $location = Location::find($locationId);
        $trainer = Trainer::find($trainerId);
        $trainerName = "$trainer->firstName $trainer->lastName";

        try {
            $message = "Trainer $trainerName (ID:$trainer->id) is ";
            if (!in_array($course->topic, $trainer->competencies)) {
                throw new \Exception("$message not qualified in this Course: $course->name (ID: $course->id) topic: $course->topic");
            }

            if ($trainer->level < $course->level) {
                throw new \Exception("$message not high enough level ($trainer->level) for this Course: $course->name (ID: $course->id) at level $course->level");
            }

            if ($trainer->city !== $location->city) {
                throw new \Exception("$message not in the same city ($trainer->city) as this Location: $location->city");
            }

            if ($trainer->needWheelchair && !$location->wheelchairAccessible) {
                throw new \Exception("$message unable to teach at this Location: $location->name (ID:$location->id) due to accessibility limitations");
            }

        } catch (\Exception $err) {
            $error->trainer_id = $err->getMessage();
            throw new \Exception(json_encode($error));
        }
    }

    // ============================================================================================

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $code = 200;
        $with = ["course", "location", "trainer"];
        $output = Booking::with($with)->orderBy("start")->get();

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
        $code = 201;
        $output = null;

        try {
            $form = $this->validateBooking($request);

            $output = Booking::create($form);
        } catch (\Throwable $error) {
            [$output["error"], $code] = $this->handleError($error);
        }

        return response($output, $code);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $code = 200;
        $with = ["course", "location", "trainer"];
        $output = Booking::with($with)->find($id);

        if ($output) {
            $output->students = Student::whereIn("id", $output->students)->get();
        } else {
            $code = 404;
        }

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
