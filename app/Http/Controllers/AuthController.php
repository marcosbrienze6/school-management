<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
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

        $token = base64_encode(Str::random(40) . '|' . now()->addMinutes(30));
        $data = [
        'title' => 'Redefinição de Senha',
        'body' => 'Clique no link abaixo para redefinir sua senha.',
        'link' => url("/api/auth/password/reset?token=" . urlencode($token))
        ];

        Mail::send('emailTest', compact('data'), fn($message) => $message->to($email)->subject('Recuperação de Senha'));

        return response()->json(['success' => true, 'message' => 'E-mail de recuperação enviado!']);
    }

    public function resetPassword(Request $request)
    {
        $token = $request->input('token');
        $newPassword = $request->input('password');

        try {
            [$randomString, $expiry] = explode('|', base64_decode($token));
            if (now() > $expiry) {
                return response()->json(['error' => 'Token expirado.'], 400);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Token inválido.'], 400);
        }

        $user = User::where('email', $request->input('email'))->first();

        if (!$user) {
            return response()->json(['error' => 'Usuário não encontrado.'], 404);
        }

        $user->update(['password' => Hash::make($newPassword)]);

        return response()->json([
        'success' => true, 'message' => 'Senha redefinida com sucesso.']);
    }

    public function update(UpdateUserRequest $request)
    {
        $user = Auth::user();
        $user->update(array_filter($request->validated()));

        return response()->json(['success' => true, 'message' => 'Usuário atualizado com sucesso.', 'user' => $user]);
    }

    public function delete()
    {
        Auth::user()->delete();
        return response()->json(['success' => true, 'message' => 'Usuário deletado com sucesso.']);
    }
}
