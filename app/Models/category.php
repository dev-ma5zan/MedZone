<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable = [
        'name',
        'icon',
        'slug',
        'category_id',
        'visability',
    ];

    public function Category()
    {
        return $this->belongsTo(Category::class);
    }

    public function Product()
    {
        return $this->hasMany(Product::class);
    }
}
