<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::orderBy('order')->paginate(10);
        return view('admin.banners.index', compact('banners'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'link' => 'nullable|url',
            'status' => 'required|boolean'
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('uploads/banners'), $imageName);
        }

        Banner::create([
            'title' => $request->title,
            'image' => 'uploads/banners/' . $imageName,
            'link' => $request->link,
            'status' => $request->status,
            'order' => Banner::max('order') + 1
        ]);

        return redirect()->route('admin.banners.index')
            ->with('success', 'Thêm banner thành công!');
    }
}