<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable = [
        'customer_id',
        'product_id',
        'notes',
        'rating',
    ];

    public function Customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function Product()
    {
        return $this->belongsTo(Product::class);
    }
}
