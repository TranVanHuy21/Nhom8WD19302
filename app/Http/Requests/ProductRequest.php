<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'stock' => 'required|integer|min:0',
            'status' => 'required|in:active,inactive'
        ];

        if ($this->isMethod('POST')) {
            $rules['image'] = 'required|image|mimes:jpeg,png,jpg|max:2048';
        }

        if ($this->isMethod('PUT')) {
            $rules['image'] = 'nullable|image|mimes:jpeg,png,jpg|max:2048';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên sản phẩm',
            'category_id.required' => 'Vui lòng chọn danh mục',
            'price.required' => 'Vui lòng nhập giá',
            'price.numeric' => 'Giá phải là số',
            'price.min' => 'Giá không được âm',
            'stock.required' => 'Vui lòng nhập số lượng',
            'stock.integer' => 'Số lượng phải là số nguyên',
            'stock.min' => 'Số lượng không được âm',
            'image.required' => 'Vui lòng chọn ảnh',
            'image.image' => 'File phải là ảnh',
            'image.mimes' => 'Ảnh phải có định dạng: jpeg, png, jpg',
            'image.max' => 'Kích thước ảnh tối đa là 2MB'
        ];
    }
}