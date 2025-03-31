<?php
namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ProductsExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Product::with('category')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Tên sản phẩm',
            'Danh mục',
            'Giá',
            'Số lượng',
            'Trạng thái',
            'Ngày tạo'
        ];
    }

    public function map($product): array
    {
        return [
            $product->id,
            $product->name,
            $product->category->name,
            number_format($product->price) . 'đ',
            $product->stock,
            $product->status == 'active' ? 'Đang bán' : 'Ngừng bán',
            $product->created_at->format('d/m/Y H:i:s')
        ];
    }
}