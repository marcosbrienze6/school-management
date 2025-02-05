<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Student;
use App\Models\Teacher;

class UserController extends Controller
{
    protected function respondWithToken($token)
    {
        return response()->json([
        'access_token' => $token,
        'token_type' => 'bearer',
        'user' => auth('api')->user(),
        ]);
    }

    public function index()
    {
        return response()->json(User::all());
    }

    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'Usuário não encontrado'], 404);
        }
        return response()->json($user);
    }
    
    public function create(UserRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);

        if ($data['role'] === 'student') {

            if (Student::where('registration_number', $data['registration_number'])->exists()) {
            return response()->json([
                'error' => true,
                'message' => 'Registration number already exists.'
            ], 400);
           }

        Student::create([
            'user_id' => (int) $user->id,
            'grade_module' => $data['grade_module'],
            'registration_number' => $data['registration_number'],
            'birth_date' => $data['birth_date'] ?? now(),
        ]);
        }

        if ($data['role'] === 'teacher') {
        Teacher::create([
            'user_id' => $user->id,
            'department' => $data['department'],
            'grade_module' => $data['grade_module'],
            'birth_date' => $data['birth_date'] ?? now(),
        ]);
        }

        return response()->json(['error' => false, 'user' => $user]);
    }

}
