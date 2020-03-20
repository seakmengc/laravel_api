<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class UserRoleValidator extends FormRequest
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
                    'role' => ['required', 'exists:roles,name', Rule::notIn(['super admin'])],
                    'user_id' => 'required|exists:users,id'
                ];
            case 'GET':
            case 'DELETE':
                return [
                    'role' => ['exists:roles,name', Rule::notIn(['super admin'])],
                    'user_id' => 'exists:users,id'
                ];
            default:
                return [];
        }
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), Response::HTTP_BAD_REQUEST));
    }
}
