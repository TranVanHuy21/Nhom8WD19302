<?php
namespace App\Observers;

use App\Models\Product;
use Illuminate\Support\Facades\Cache;

class ProductObserver
{
    public function created(Product $product)
    {
        $this->clearCache();
    }

    public function updated(Product $product)
    {
        $this->clearCache();
    }

    public function deleted(Product $product)
    {
        $this->clearCache();
    }

    protected function clearCache()
    {
        Cache::tags(['products'])->flush();
    }
}