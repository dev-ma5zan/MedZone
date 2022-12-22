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
    ];

    public function area()
    {
        return $this->hasMany(area::class);
    }

    public function SubAddress()
    {
        return $this->hasMany(SubAddress::class);
    }
}
