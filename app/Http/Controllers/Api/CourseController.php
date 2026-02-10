<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller {
    public function index() { return Course::all(); }

    public function store(Request $request) {
        $data = $request->validate(['name' => 'required', 'description' => 'nullable']);
        return Course::create($data);
    }

    public function update(Request $request, Course $course) {
        $data = $request->validate(['name' => 'required', 'description' => 'nullable']);
        $course->update($data);
        return $course;
    }

    public function destroy(Course $course) {
        $course->delete();
        return response()->noContent();
    }
}