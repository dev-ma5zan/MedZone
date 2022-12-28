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
    ];

    public function Category()
    {
        return $this->belongsTo(Category::class);
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

    public function offer()
    {
        return $this->hasMany(offer::class);
    }

    public function order() 
    {
      return $this->hasMany(order::Class);
    }

}
