<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;


class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
    */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
    */


    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:5', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed',  Password::min(8)],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'   => 'The name is required.',
            'email.required'      => 'The email is required.',
            'email.email'         => 'The email format is invalid.',
            'email.unique'        => 'This email is already exist.',
            'password.required'   => 'The password is required.',
            'password.min'        => 'The password must be at least 8 characters.',
            'password.confirmed'  => 'Password confirmation does not match.',
        ];
    }


    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'success' => false,
                'message' => 'Les données fournies sont invalides',
                'errors' => $validator->errors()->messages()
            ], 422)
        );
    }


}
