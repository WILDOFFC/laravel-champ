<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'max:30', 'string'],
            'description' => ['nullable', 'max:100', 'string'],
            'hours' => ['required','max: 10', 'integer'],
            'price' => ['required', 'min: 100', 'integer'],
            'start_date' => ['required'],
            'end_date' => ['required'],
            'img' => ['required', 'image', 'mimes: jpg, jpeg', 'max: 2000'],
        ];
    }
}
