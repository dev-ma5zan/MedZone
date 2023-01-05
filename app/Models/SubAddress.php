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
        'weight',
    ];

    public function Sector()
    {
        return $this->belongsTo(Sector::class);
    }

    public function Customer()
    {
        return $this->hasMany(Customer::class);
    }

    public function Street()
    {
        return $this->hasMany(Street::class);
    }
}
