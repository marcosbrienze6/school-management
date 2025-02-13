<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;

use Tymon\JWTAuth\Facades\JWTAuth;

class StudentController extends Controller
{
    public function create(StudentRequest $request)
    {
        $data = $request->validated();
        $user = Auth::user();

        if (!$user) {
            return response()->json(['error' => true, 'message' => 'Usuário não autenticado.'], 401);
        }
        
        $data['user_id'] = $user->id;
        $student = Student::create($data);

        $token = JWTAuth::fromUser($student);

        return response()->json([
        'error' => false,
        'message' => 'Usuário criado e logado',
        'user' => $student,
        'access_token' => $token,
        'token_type' => 'bearer' ]);
    }

    public function update(UpdateStudentRequest $request, $userId)
    {
        $student = Student::find($userId);

        $student->update($request->validated());

        return response()->json([
        'error' => false,
        'message' => 'Usuário atualizado com sucesso.',
        'student' => $student,
        ]);
    }

    public function delete($userId)
    {
        $student = Student::find($userId);
        
        $student->delete();

        return response()->json([
        'error' => false,
        'message' => 'Usuário deletado com sucesso.'
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
