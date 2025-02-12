<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;


class StudentController extends Controller
{
    public function create(StudentRequest $request)
    {
        $data = $request->validated();
        $user = Auth::user();
        
        $data['user_id'] = $user->id;
        $user = Student::create($data);

        return response()->json(['error' => false, 'user' => $user]);
    }

    public function update(UpdateStudentRequest $request)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['error' => true, 'message' => 'Usuário não autenticado.'], 401);
        }

        $user->update($request->validated());

        return response()->json([
        'error' => false,
        'message' => 'Usuário atualizado com sucesso.',
        'user' => $user,
        ]);
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
