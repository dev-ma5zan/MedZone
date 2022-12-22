<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class product extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable = [
        'code',
        'category_id',
        'tags',
        'availability',
        'visability',
        'featured',
        'vendor_id',
        'serial_number',
        'featured_cover_image',
        'images',
        'description',
        'documents',
        'links',
        'properties',
        'prices',
    ];

    public function TopCategory()
    {
        return $this->belongsTo(TopCategory::class);
    }

    public function vendor()
    {
        return $this->belongsTo(vendor::class);
    }

    public function review()
    {
        return $this->hasMany(review::class);
    }

    public function contract()
    {
        return $this->belongsTo(contract::class);
    }

    public function order() 
    {
      return $this->belongsToMany(order::Class, 'order_has_products');
    }

}
