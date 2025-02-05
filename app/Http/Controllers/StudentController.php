<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class StudentController extends Controller
{
    public function create(Request $request)
    {
        $data = $request->validate([
        'name' => 'required|string|max:255',
        ]);

        $student = Student::create($data);

        return response()->json(['student' => $student]);
    }

    public function getGrades($id)
    {
        $student = Student::with('grades.course')->findOrFail($id);
        $student->load('grades');
        return response()->json($student->grades);
    }

    public function getAttendance($id)
    {
        $student = Student::with('attendance')->findOrFail($id);
        return response()->json($student->attendance);
    }
}
