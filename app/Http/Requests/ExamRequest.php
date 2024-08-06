<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExamRequest extends FormRequest
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
            "name_en"=>"required|string|max:250",
            "name_ar"=>"required|string|max:50",
            'img'=>"nullable|image|max:2048",
            'desc_en'=>"required|string|max:5000",
            'desc_ar'=>"required|string|max:5000",
            'duration_mins'=>"required|integer|min:5",
            'questions_no'=>"required|integer|min:2",
            'difficulty'=>"required|integer|min:1|max:5",
            'skill_id'=>"required|exists:skills,id"
        ];
    }
}
