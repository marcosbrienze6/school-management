<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;

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
    
    public function create(UserRequest $request)
    {
        $data = $request->validated();

        $user = User::create($data);

        if (!$token = auth('api')->attempt($data)) {
            return response()->json(['error' => 'Credenciais incorretas.'], 401);
        }

        return $this->respondWithToken($token);
    } 

}
