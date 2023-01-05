<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
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
        'pictures',
        'description',
        'documents',
        'links',
        'properties',
        'prices',
    ];

    protected $casts = [
        'documents' => 'json',
        'pictures' => 'json',
        'links' => 'json',
        'properties' => 'json',
        'prices' => 'json',
    ];

    public function Category()
    {
        return $this->belongsTo(Category::class);
    }

    public function Vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function Review()
    {
        return $this->hasMany(Review::class);
    }

    public function Contract()
    {
        return $this->belongsTo(Contract::class);
    }

    public function Offer()
    {
        return $this->hasMany(Offer::class);
    }

    public function Order() 
    {
      return $this->hasMany(Order::Class);
    }

}
