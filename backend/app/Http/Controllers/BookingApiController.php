<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Illuminate\Validation\ValidationException;
use Carbon\Carbon;
use App\Models\{
    Booking,
    Student
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
        //     // student ID error
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

    // ============================================================================================

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $code = 200;
        $output = Booking::all();

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
        $output = Booking::find($id);

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
