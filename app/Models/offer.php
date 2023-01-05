<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Offer extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable = [
        'code',
        'title',
        'products',
        'starts_at',
        'ends_at',
        'customer_id',
        'minimal_total_price',
        'discount_percentage',
        'new_price',
    ];

    protected $casts = [
        'products' => 'json',
        'customer_id' => 'array',
    ];

    public function Customer()
    {
        return $this->belongsToMany(Customer::class);
    }

    public function Product()
    {
        return $this->belongsTo(Product::class);
    }
}
