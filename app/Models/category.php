<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class category extends Model
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

    public function category()
    {
        return $this->belongsTo(category::class);
    }

    public function product()
    {
        return $this->hasMany(product::class);
    }
}
