<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class RoleValidator extends FormRequest
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
                    'name' => 'required|unique:roles,name',
                    'guard_name' => ['required', Rule::in(['api', 'web'])]
                ];
            case 'PUT':
            case 'PATCH':
                return [
                    'old_name' => 'exists:roles,name',
                    'name' => 'unique:roles,name,' . $this->route()->id,
                    'guard_name' => [Rule::in(['api', 'web'])]
                ];
            case 'DELETE':
                return [
                    'name' => 'exists:roles,name',
                ];
        }
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), Response::HTTP_BAD_REQUEST));
    }
}
