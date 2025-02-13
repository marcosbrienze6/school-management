<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeacherRequest;
use App\Http\Requests\UpdateTeacherRequest;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class TeacherController extends Controller
{
    public function create(TeacherRequest $request)
    {
        $data = $request->validated();
        $user = Auth::user();
        
        $data['user_id'] = $user->id;
        $teacher = Teacher::create($data);

        $token = JWTAuth::fromUser($teacher);

        return response()->json([
        'error' => false,
        'teacher' => $teacher,
        'access_token' => $token,
        'token_type' => 'bearer'
        ]);
    }

    public function update(UpdateTeacherRequest $request, $userId)
    {
        $teacher = Teacher::find($userId);
        $teacher->update($request->validated());

        return response()->json([
        'error' => false,
        'message' => "Professor atualizado com sucesso",
        'teacher' => $teacher
        ]);
    }

    public function delete($userId)
    {
        $teacher = Teacher::find($userId);
        $teacher->delete();

        return response()->json([
        'error' => false,
        'message' => "Professor deletado com sucesso"
        ]);
    }
}
