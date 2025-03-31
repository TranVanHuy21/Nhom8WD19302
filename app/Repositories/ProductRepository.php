<?php
namespace App\Repositories;

use App\Models\Product;
use Illuminate\Support\Facades\Cache;

class ProductRepository
{
    protected $model;

    public function __construct(Product $model)
    {
        $this->model = $model;
    }

    public function getAllWithCache()
    {
        return Cache::remember('products.all', 3600, function () {
            return $this->model->with('category')->get();
        });
    }

    public function create(array $data)
    {
        $product = $this->model->create($data);
        Cache::forget('products.all');
        return $product;
    }

    public function update($id, array $data)
    {
        $product = $this->model->findOrFail($id);
        $product->update($data);
        Cache::forget('products.all');
        return $product;
    }

    public function delete($id)
    {
        $product = $this->model->findOrFail($id);
        Cache::forget('products.all');
        return $product->delete();
    }
}