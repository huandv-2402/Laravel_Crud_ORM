<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestStoreProduct extends FormRequest
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
            "name" => "required|min:8|max:150|unique:products,name",
            "quantity" => "required|min:1|integer",
            "price" => "required|min:0|numeric",
            "image" => "required|image",
            "description" => "required",
            "category_id" => "exists:categories,id"
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
            "image.required" => " * Ảnh không được bỏ trống",
            "quantity.required" => " * Số lượng không được bỏ trống",
            "quantity.min" => " * Số lượng không được nhỏ hơn 0",
            "quantity.integer" => " * Số lượng phải là số nguyên",
            "price.required" => " * Giá không được bỏ trống",
            "price.min" => " * Giá không được nhỏ hơn 0",
            "price.numeric" => " * Giá phải là số",
            "description" => " * Mô tả không được bỏ trống",
            "category_id.exists" => " * Danh mục không tồn tại",
            "category_id.required" => " * Danh mục không được bỏ trống"
        ];     
    }
}
