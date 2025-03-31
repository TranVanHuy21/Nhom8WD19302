<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Promotion;
use App\Models\Product;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    public function index()
    {
        $promotions = Promotion::latest()->paginate(10);
        return view('admin.promotions.index', compact('promotions'));
    }

    public function create()
    {
        $products = Product::where('status', 'active')->get();
        return view('admin.promotions.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:promotions',
            'name' => 'required|string|max:255',
            'discount_type' => 'required|in:percentage,fixed',
            'discount_value' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'products' => 'required|array',
            'min_order_amount' => 'nullable|numeric|min:0',
            'max_discount_amount' => 'nullable|numeric|min:0',
            'usage_limit' => 'nullable|integer|min:1'
        ]);

        $promotion = Promotion::create($request->all());
        $promotion->products()->sync($request->products);

        return redirect()->route('admin.promotions.index')
            ->with('success', 'Thêm khuyến mãi thành công!');
    }
}