<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestPostAdmin extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
        // return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "email" => "required|email|exists:users,email",
            "password" => "required"
        ];
    }

    public function messages()
    {
        return [
            "email.required" => " * Email không được bỏ trống",
            "email.email" => " * Sai định dạng Email",
            "email.exists" => " * Email chưa được đăng ký",
            "password.required" => " * Mật khẩu không được bỏ trống"
        ];
    }
}
