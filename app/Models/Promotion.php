<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $fillable = [
        'code',
        'name',
        'description',
        'discount_type', // percentage, fixed
        'discount_value',
        'start_date',
        'end_date',
        'min_order_amount',
        'max_discount_amount',
        'usage_limit',
        'used_count',
        'status'
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}