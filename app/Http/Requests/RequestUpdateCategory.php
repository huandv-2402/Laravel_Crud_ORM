<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class RequestUpdateCategory extends FormRequest
{

    

    public function authorize(): bool
    {
        // return false;
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */ 

    protected function prepareForValidation()
    {
        $this->merge(['id' => $this->route('category')]);
    }


    public function rules(): array
    {
 
        return [
            // "name" => "required|min:8|max:150",Rule::unique("categories","name")->ignore($this->categoryId,"id"),
            "name" => "required|min:8|max:150|unique:categories,name," . $this->id,
            "image" => "image"
        ];
    }

    public function messages()
    {
        return [
            "name.required" => " * Tên không được bỏ trống",
            "name.min" => " * Độ dài tên không được < 8 ký tụ",
            "name.max"=>" * Độ dài tên không được > 150 ký tự",
            "name.unique" => " * Tên đã tồn tại",
            "image.image" => " * File gửi lên phải là file ảnh",
        ];
    }
}
