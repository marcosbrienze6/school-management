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
        'email' => 'required|string|email|max:255',
        'password' => 'required|string|min:8',
        'cpf' => 'required',
        'address' => 'nullable|string|max:255',
        'role' => 'required|in:student,teacher,admin',
        'registration_number' => 'required_if:role,student|integer|unique:students,registration_number',
        'grade_module' => 'required_if:role,student|in:1,2,3',
        'department' => 'required_if:role,teacher|string',
        'birth_date' => 'nullable|date',
        ];  
    }
}
