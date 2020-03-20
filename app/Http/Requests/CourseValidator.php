<?php

namespace App\Http\Requests;

use App\Rules\IsInstructor;
use App\Rules\ValidAcademic;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class CourseValidator extends FormRequest
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
                    'academic_y1' => ['required', 'numeric', new ValidAcademic],
                    'academic_y2' => ['required', 'numeric', new ValidAcademic],
                    'semester' => 'required|min:1|max:8',
                    'name' => 'required|max:100|unique:courses',
                    'code' => 'required|max:10|unique:courses',
                    'description' => 'required|max:65535',
                    'department_id' => 'required|exists:departments,id',
                    'taught_by' => ['exists:users,id',  new IsInstructor]
                ];
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'academic_y1' => ['numeric', new ValidAcademic],
                    'academic_y2' => ['numeric', new ValidAcademic],
                    'semester' => 'min:1|max:8',
                    'name' => 'max:100|unique:courses,name,' . $this->route('course')->id,
                    'code' => 'max:10|unique:courses,code,' . $this->route('course')->id,
                    'description' => 'max:65535',
                    'department_id' => 'exists:departments,id',
                    'taught_by' => ['exists:users,id', new IsInstructor]
                ];
            }
            default:
                return [];
        }

    }

    public function validated()
    {
        $validated = parent::validated();

        if(isset($validated['academic_y1']) && isset($validated['academic_y2']))
            $validated['academic'] = $validated['academic_y1'] . '-' . $validated['academic_y2'];
        unset($validated['academic_y1']);
        unset($validated['academic_y2']);

        return $validated;
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), Response::HTTP_BAD_REQUEST));
    }
}
