<?php
namespace App\Services;

use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class FileUploadService
{
    public function uploadImage($file, $path, $sizes = [])
    {
        $fileName = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
        $filePath = $path . '/' . $fileName;

        // Upload ảnh gốc
        Storage::disk('public')->put($filePath, file_get_contents($file));

        // Tạo thumbnail
        foreach ($sizes as $size) {
            $img = Image::make($file);
            $thumbPath = $path . '/thumb_' . $size . '_' . $fileName;

            $img->resize($size, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            Storage::disk('public')->put($thumbPath, $img->encode());
        }

        return $filePath;
    }

    public function deleteImage($path)
    {
        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);

            // Xóa các thumbnail
            $directory = dirname($path);
            $filename = basename($path);
            $files = Storage::disk('public')->files($directory);

            foreach ($files as $file) {
                if (Str::contains($file, 'thumb_') && Str::contains($file, $filename)) {
                    Storage::disk('public')->delete($file);
                }
            }
        }
    }
}