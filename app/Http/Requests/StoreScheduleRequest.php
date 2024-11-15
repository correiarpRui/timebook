<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreScheduleRequest extends FormRequest
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
            'name'=>['required'],
            'morning_start'=>['required', 'date_format:H:i'],
            'morning_end'=>['required', 'date_format:H:i','after:morning_start'],
            'afternoon_start'=>['required', 'date_format:H:i','after:morning_end'],
            'afternoon_end'=>['required', 'date_format:H:i', 'after:afternoon_start'],
            'monday' => ['sometimes', 'nullable'],
            'tuesday' => ['sometimes', 'nullable'],
            'wednesday' => ['sometimes', 'nullable'],
            'thursday' => ['sometimes', 'nullable'],
            'friday' => ['sometimes', 'nullable'],
            'saturday' => ['sometimes', 'nullable'],
            'sunday' => ['sometimes', 'nullable'],
        ];
    }
}
