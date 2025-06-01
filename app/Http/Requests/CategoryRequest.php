<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
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
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'description' => 'nullable|string',
            'meta_title' => 'nullable|string|max:70',
            'meta_description' => 'nullable|string|max:160',
        ];

        // If updating a category, add unique slug check excluding current category
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $rules['name'][] = Rule::unique('categories')->ignore($this->category->id)->where(function ($query) {
                return $query->where('slug', Str::slug($this->name));
            });
        } else {
            // If creating a new category, simple unique slug check
            $rules['name'][] = Rule::unique('categories')->where(function ($query) {
                return $query->where('slug', Str::slug($this->name));
            });
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
            'name.required' => 'กรุณาระบุชื่อหมวดหมู่',
            'name.unique' => 'ชื่อหมวดหมู่นี้ถูกใช้งานแล้ว',
            'meta_title.max' => 'Meta Title ไม่ควรเกิน 70 ตัวอักษร',
            'meta_description.max' => 'Meta Description ไม่ควรเกิน 160 ตัวอักษร',
        ];
    }
}