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
        if ($this->isMethod('post')) {
            return [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|unique:users,email',
                'password' => 'required|string|min:6',
                'cpf' => 'required|numeric',
                'address' => 'nullable|string|max:255',
                'phone_number' => 'sometimes'
            ];
        } elseif ($this->isMethod('put') || $this->isMethod('patch')) {
            return [
                'name' => 'sometimes|string|max:255',
                'email' => 'sometimes|string|email|unique:users,email,' . $this->user->id,
                'password' => 'nullable|string|min:6',
                
                'address' => 'nullable|string|max:255',
                'phone_number' => 'sometimes'
            ];
        }

        return [];
    }
}
