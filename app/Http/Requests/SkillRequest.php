<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SkillRequest extends FormRequest
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
            "id"=>"required|exists:skills,id",
            "name_en"=>"required|string|max:250",
            "name_ar"=>"required|string|max:50",
            'img'=>"nullable|image|max:2048",
            'cat_id'=>"required|exists:cats,id"
        ];
    }
}
