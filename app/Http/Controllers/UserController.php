<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;



use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        return response()->json(User::all());
    }
    
    public function create(UserRequest $request)
    {
        $data = $request->validated();

        $user = User::create($data);

        return response()->json(['message' => 'deu certo pai', 'user' => $user]);
    } 

}
