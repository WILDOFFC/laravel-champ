<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LessonRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name'=>['required', 'max: 50'],
            'description'=>['required'],
            'video_link'=>['nullable'],
            'hours'=>['required', 'max: 4']
        ];
    }
}
