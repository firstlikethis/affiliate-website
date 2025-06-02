<?php
// app/Http/Requests/ArticleRequest.php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ArticleRequest extends FormRequest
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
            'title' => [
                'required',
                'string',
                'max:255',
            ],
            'content' => 'required|string',
            'meta_title' => 'nullable|string|max:70',
            'meta_description' => 'nullable|string|max:160',
            'products' => 'nullable|array',
            'products.*' => 'exists:products,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ];

        // Handle unique slug validation
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $rules['title'][] = Rule::unique('articles')->ignore($this->article->id)->where(function ($query) {
                return $query->where('slug', Str::slug($this->title));
            });
        } else {
            $rules['title'][] = Rule::unique('articles')->where(function ($query) {
                return $query->where('slug', Str::slug($this->title));
            });
            
            // Require thumbnail only when creating
            $rules['thumbnail'] = 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048';
        }

        // Make thumbnail optional when updating
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $rules['thumbnail'] = 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048';
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
            'title.required' => 'กรุณาระบุหัวข้อบทความ',
            'title.unique' => 'หัวข้อบทความนี้ถูกใช้งานแล้ว',
            'content.required' => 'กรุณาระบุเนื้อหาบทความ',
            'thumbnail.required' => 'กรุณาอัปโหลดรูปภาพปก',
            'thumbnail.image' => 'ไฟล์ที่อัปโหลดต้องเป็นรูปภาพเท่านั้น',
            'thumbnail.mimes' => 'รูปภาพต้องเป็นไฟล์ประเภท jpeg, png, jpg, gif หรือ webp เท่านั้น',
            'thumbnail.max' => 'รูปภาพต้องมีขนาดไม่เกิน 2MB',
            'products.*.exists' => 'สินค้าที่เลือกไม่มีอยู่ในระบบ',
            'tags.*.exists' => 'แท็กที่เลือกไม่มีอยู่ในระบบ',
            'meta_title.max' => 'Meta Title ไม่ควรเกิน 70 ตัวอักษร',
            'meta_description.max' => 'Meta Description ไม่ควรเกิน 160 ตัวอักษร',
        ];
    }
}