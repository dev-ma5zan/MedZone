<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class offer extends Model
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
    ];

    public function customer()
    {
        return $this->belongsToMany(customer::class);
    }

    public function product()
    {
        return $this->belongsTo(product::class);
    }
}
