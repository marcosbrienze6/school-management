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
        'cpf' => 'required|unique:user',
        'address' => 'nullable|string|max:255',
        'role' => 'required|in:student,teacher,admin',
        'registration_number' => 'required_if:role,student|integer|unique:students,registration_number',
        'grade_module' => 'required_if:role,student|in:module_1,module_2,module_3',
        'department' => 'required_if:role,teacher|string',
        'birth_date' => 'nullable|date',
        ];  
    }
}
