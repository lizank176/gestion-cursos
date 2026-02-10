<?php  

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller {
    public function index() { 
        return Student::with('course')->get(); 
    }

    public function store(Request $request) {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:students',
            'course_id' => 'required|exists:courses,id'
        ]);
        return Student::create($data);
    }

    public function update(Request $request, Student $student) {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:students,email,'.$student->id,
            'course_id' => 'required|exists:courses,id'
        ]);
        $student->update($data);
        return $student;
    }

    public function destroy(Student $student) {
        $student->delete();
        return response()->noContent();
    }
}