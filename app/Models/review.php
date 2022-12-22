<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class review extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable = [
        'customer_id',
        'product_id',
        'notes',
        'rating',
    ];

    public function customer()
    {
        return $this->belongsTo(customer::class);
    }

    public function product()
    {
        return $this->belongsTo(product::class);
    }
}
