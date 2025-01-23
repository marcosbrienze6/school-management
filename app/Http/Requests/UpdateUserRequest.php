<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
           'name'   => 'max:255|string',
            'email'  => 'max:255|email|unique:user,email',
            'gender' => 'in:male,female|string',
            'cpf'    => [
                'prohibited',
            ],
            'password' => 'nullable|min:8'
        ];
    }
}
