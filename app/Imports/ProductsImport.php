<?php
namespace App\Imports;

use App\Models\Product;
use App\Models\Category;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Str;

class ProductsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $category = Category::where('name', $row['danh_muc'])->first();

        return new Product([
            'name' => $row['ten_san_pham'],
            'slug' => Str::slug($row['ten_san_pham']),
            'price' => str_replace(['đ', ','], '', $row['gia']),
            'category_id' => $category ? $category->id : null,
            'stock' => $row['so_luong'],
            'status' => $row['trang_thai'] == 'Đang bán' ? 'active' : 'inactive',
            'description' => $row['mo_ta'] ?? null
        ]);
    }
}