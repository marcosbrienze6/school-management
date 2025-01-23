<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Mail;


class TaskController extends Controller
{
    protected $modelInstance;

    public function __construct(Task $modelInstance) {
        $this->modelInstance = $modelInstance;
    }

    protected function respondWithToken($token)
    {
        return response()->json([
        'access_token' => $token,
        'token_type' => 'bearer',
        'user' => auth('api')->user(),
        ]);
    }

    public function create(TaskRequest $request)
    {
       $validated = $request->validated();

       $user = Auth::user();

       $task = Task::create([
        'user_id' => $user->id,
        'title' => $validated['title'],
        'is_completed' => $validated['is_completed'],
        'description' => $validated['description'],
        'due_date' => $validated['due_date'],
       ]);

       return response()->json(['message' => 'Tarefa criada com sucesso!', 'data' => $task], 201);
    }

    public function index()
    {
        $tasks = Task::all();
        return response()->json($tasks);
    }

    public function update(TaskRequest $request, $taskId)
    {   
        $user = Auth::user();

        $task = $this->modelInstance
        ->where('id', $taskId)
        ->where('user_id', $user->id)
        ->first();

        if (!$task) {
        return response()->json([
        'error' => true,
        'message' => 'Tarefa não encontrada ou não pertence ao usuário.'
        ], 404);
        }

        $task->update($request->validated());

        return response()->json([
        'error' => false,
        'message' => 'Tarefa atualizada com sucesso.',
        'data' => $task
        ], 200);
    }

    public function delete(TaskRequest $request, $taskId)
    {
        $user = Auth::user();

        $task = $this->modelInstance
        ->where('id', $taskId)
        ->where('user_id', $user->id)
        ->first();

        $task->delete($request->validated());

        return response()->json([
            'error' => false,
            'message' => 'Tarefa deletada com sucesso.'
        ]);
    }
}
