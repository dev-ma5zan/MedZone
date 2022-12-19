<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubAddress extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable = [
        'name',
        'sector_id',
    ];

    public function sector()
    {
        return $this->belongsTo(sector::class);
    }

    public function street()
    {
        return $this->hasMany(street::class);
    }
}
