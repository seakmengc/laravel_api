<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class UserValidator extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
                return [
                    'email' => 'required|max:50|email|unique:users',
                    'username' => 'required|max:30|unique:users',
                    'phone_number' => 'required|max:15|unique:users',
                    'password' => 'required|max:100|confirmed',
                ];
            case 'PUT':
            case 'PATCH':
                return [
                    'password' => 'required|max:100|confirmed',
                ];
        }
    }

    public function validated()
    {
        $validated = parent::validated();

        $validated['password'] = bcrypt($validated['password']);

        return $validated;
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), Response::HTTP_BAD_REQUEST));
    }
}
