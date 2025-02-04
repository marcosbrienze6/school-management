<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class StudentController extends Controller
{
    public function create(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:students,email',
    ]);

    $student = Student::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'user_id' => Auth::user(), 
    ]);

    return response()->json($student, 201);
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
