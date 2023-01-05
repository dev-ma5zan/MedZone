<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sector extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable = [
        'name',
        'area_id',
        'weight',
    ];

    public function Area()
    {
        return $this->belongsTo(Area::class);
    }

    public function Customer()
    {
        return $this->hasMany(Customer::class);
    }

    public function SubAddress()
    {
        return $this->hasMany(SubAddress::class);
    }
}
