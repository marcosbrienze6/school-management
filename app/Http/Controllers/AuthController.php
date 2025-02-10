<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\PasswordMail;
use Illuminate\Support\Facades\Hash;
use App\Models\Student;

use Illuminate\Support\Str;

class AuthController extends Controller
{
    protected function respondWithToken($token)
    {
        return response()->json([
        'access_token' => $token,
        'token_type' => 'bearer',
        'user' => auth('api')->user(),
        ]);
    }

    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);

        if (!$token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Credenciais incorretas.'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function logout()
    {
        if (!auth('api')->check()) {
            return response()->json(['error' => 'Token inválido ou expirado.'], 401);
        }

        auth('api')->logout();
        return response()->json(['message' => 'Logout realizado com sucesso.']);
    }

    public function sendResetEmail(Request $request)
    {
        $email = $request->input('email');
        $user = User::where('email', $email)->first();

        if (!$user) {
            return response()->json(['error' => 'E-mail não encontrado.'], 404);
        }

        $expiry = now()->addMinutes(60)->timestamp;
        $token = base64_encode("{$user->email}|{$expiry}|".Str::random(32));
        $data = new \stdClass();
        $data->title = 'Redefinição de Senha';
        $data->body = 'Clique no link abaixo para redefinir sua senha.';
        $data->link = url("http://localhost:5173/password-reset?token=" . urlencode($token));

        try {
            Mail::to($email)->send(new PasswordMail($data));
            return response()->json(['success' => true, 'message' => 'E-mail de recuperação enviado!']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Falha ao enviar o e-mail.', 'details' => $e->getMessage()], 500);
        }
    }

    public function resetPassword(Request $request)
    {
        $token = $request->input('token');
        $newPassword = $request->input('password');
 
        try {
            [$email, $expiry, $randomString] = explode('|', base64_decode($token));

            if (now()->timestamp > $expiry) {
            return response()->json(['error' => 'Token expirado.'], 400);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Token inválido.'], 400);
        }

        $user = User::where('email', $email)->first();

        if (!$user) {
            return response()->json(['error' => 'Usuário não encontrado.'], 404);
        }

        $user->update(['password' => Hash::make($newPassword)]);

        return response()->json([
        'success' => true, 
        'message' => 'Senha redefinida com sucesso.'
        ]);
    }

    public function myProfile()
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['error' => true, 'message' => 'Usuário não autenticado.'], 401);
        }
    
        $studentData = $user->student ? [
            'grade_module' => $user->student->grade_module,
            'registration_number' => $user->student->registration_number,
            'birth_date' => $user->student->birth_date,
        ] : null;
    
        return response()->json([
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'cpf' => $user->cpf,
                'role' => $user->role, 
            ],
            'profile_picture' => $user->profile_picture ? asset("storage/{$user->profile_picture}") : null,
            'student_data' => $studentData, 
        ]);
    }

    public function updateProfilePicture(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['error' => true, 'message' => 'Usuário não autenticado.']);
        }

    if (!$request->hasFile('profile_picture')) {
        return response()->json(['error' => 'Nenhuma imagem foi enviada.']);
    }

    $file = $request->file('profile_picture');

    // Validação
    $validated = $request->validate([
        'profile_picture' => 'image|mimes:jpg,jpeg,png|max:2048', 
    ]);

    // Salvar no storage
    $path = $file->store('profile_pictures', 'public');

    // Atualizar o usuário com a nova foto
    $user->profile_picture = $path;
    $user->save();

    return response()->json(['profile_picture' => asset("storage/$path")]);
    }


    public function update(UpdateUserRequest $request)
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

    public function delete()
    {
       $user = Auth::user();
        if (!$user) {
            return response()->json(['error' => true, 'message' => 'Usuário não autenticado.'], 401);
        }
        $user->delete();
        return response()->json(['success' => true, 'message' => 'Usuário deletado com sucesso.']);
    }
}



