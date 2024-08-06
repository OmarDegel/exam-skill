<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
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
            "name"=> "required|string",
            "email"=> "required|email",
            "password" => "required|min:7|max:20|confirmed",
            "password_confirmation" => "required|min:7|max:20",
            "role_id"=> "required|exists:roles,id",
        ];
    }
}
