<?php
// app/Http/Requests/UserRequest.php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function authorize()
    {
        return true; 
    }

    public function rules()
    {
        return [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:user',
        'password' => 'required|string|min:8',
        'cpf' => 'required|digits:11|unique:user',
        'address' => 'nullable|string|max:255',
        'user_role_id' => 'numeric|exists:user_role,id',   
        ];  
    }
}
