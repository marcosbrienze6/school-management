<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use App\Models\User;

class UserController extends Controller
{
    protected $modelInstance;

    public function __construct(User $user) {
      
        $this->modelInstance = $user;
    }

    public function index()
    {
        return response()->json(User::all());
    }
    
    public function create(Request $request)
    {
        $data = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|unique:user,email',
        'password' => 'required|string|min:6',
        'cpf' => 'required|numeric',
        'address' => 'nullable|string|max:255',
        ]);

        $user = User::create($data);
       
        return response()->json([
        'message' => 'Usuário criado com sucesso.',
        'user' => $user
        ]);
    }   

    public function update(Request $request)
    {
        $user = $this->modelInstance->update($request->validated());

        return response()->json([
        'message' => 'Usuário atualizado com sucesso.',
        'user' => $user], 201);
    }

    public function delete($userId)
    {
        $user = $this->modelInstance->find($userId);
        if (isset($user)) {
            return response()->json([
            'error' => false,
            'data' => $user
            ], 200);
        }

        return response()->json([
        'error' => true,
        'message' => "Usuário não encontrado.",
        ], 404);
    }
}
