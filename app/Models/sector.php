<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class sector extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable = [
        'name',
        'area_id',
        'weight',
    ];

    public function area()
    {
        return $this->belongsTo(area::class);
    }

    public function customer()
    {
        return $this->hasMany(customer::class);
    }

    public function SubAddress()
    {
        return $this->hasMany(SubAddress::class);
    }
}
