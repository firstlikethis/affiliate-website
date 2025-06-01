<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Authorization is handled by middleware
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'affiliate_link' => 'required|url',
            'category_id' => 'required|exists:categories,id',
            'is_featured' => 'sometimes|boolean',
            'meta_title' => 'nullable|string|max:70',
            'meta_description' => 'nullable|string|max:160',
        ];

        // Only require image when creating a new product
        if ($this->isMethod('POST')) {
            $rules['image'] = 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048';
        } else {
            $rules['image'] = 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048';
        }

        return $rules;
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.required' => 'กรุณาระบุชื่อสินค้า',
            'price.required' => 'กรุณาระบุราคาสินค้า',
            'price.numeric' => 'ราคาต้องเป็นตัวเลขเท่านั้น',
            'price.min' => 'ราคาต้องไม่ต่ำกว่า 0',
            'affiliate_link.required' => 'กรุณาระบุลิงก์ Affiliate',
            'affiliate_link.url' => 'ลิงก์ Affiliate ไม่ถูกต้อง',
            'category_id.required' => 'กรุณาเลือกหมวดหมู่',
            'category_id.exists' => 'หมวดหมู่ที่เลือกไม่มีอยู่ในระบบ',
            'image.required' => 'กรุณาอัปโหลดรูปภาพสินค้า',
            'image.image' => 'ไฟล์ที่อัปโหลดต้องเป็นรูปภาพเท่านั้น',
            'image.mimes' => 'รูปภาพต้องเป็นไฟล์ประเภท jpeg, png, jpg, gif หรือ webp เท่านั้น',
            'image.max' => 'รูปภาพต้องมีขนาดไม่เกิน 2MB',
            'meta_title.max' => 'Meta Title ไม่ควรเกิน 70 ตัวอักษร',
            'meta_description.max' => 'Meta Description ไม่ควรเกิน 160 ตัวอักษร',
        ];
    }
}