<?php
namespace App\Services;

use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ImageService
{
    public function uploadImage($image, $path, $sizes = [])
    {
        $fileName = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
        $fullPath = public_path($path);

        if (!file_exists($fullPath)) {
            mkdir($fullPath, 0755, true);
        }

        // Upload ảnh gốc
        $image->move($fullPath, $fileName);

        // Tạo các kích thước khác nhau
        foreach ($sizes as $size) {
            $img = Image::make($fullPath . '/' . $fileName);
            $thumbPath = $fullPath . '/thumb_' . $size . '_' . $fileName;
            $img->resize($size, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($thumbPath);
        }

        return $path . '/' . $fileName;
    }
}