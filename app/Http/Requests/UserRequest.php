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
        'email' => 'required|string|email|max:255',
        'password' => 'required|string|min:8',
        'cpf' => 'required',
        ];  
    }
}


