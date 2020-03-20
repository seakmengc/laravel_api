<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => [
                'id' => $this->id,
                'academic' => $this->academic,
                'semester' => $this->semester,
                'code' => $this->code,
                'name' => $this->name,
                'description' => $this->description,
                'department' => $this->department->name,
                'taught_by' => $this->taught_by == null ? null : $this->instructor->username
            ]
        ];
    }
}
