<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRequest;
use App\Http\Requests\UserRequest;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;


class StudentController extends Controller
{
    public function create(StudentRequest $request)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['error' => true, 'message' => 'Usuário não autenticado.'], 401);
        }
        $data = $request->validated();

        $student = Student::create([
            'role' => $data['role'],
            'user_id' => auth('api')->id()
        ]);

        return response()->json(['error' => false, 'message' => 'Aluno criado com sucesso!', 'aluno' => $student]);
    
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
