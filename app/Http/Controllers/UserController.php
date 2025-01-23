<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;

use App\Models\User;

class UserController extends Controller
{

    protected $modelInstance;

    public function __construct(User $modelInstance) {
      
        $this->modelInstance = $modelInstance;

    }

    public function index()
    {
        return response()->json(User::all());
    }

    public function create(UserRequest $request)
    {
        $user = $this->modelInstance->create($request->validated());

        return response()->json([
        'message' => 'Usuário criado com sucesso.',
        'user' => $user], 201);
    }   


    public function update(UserRequest $request)
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
