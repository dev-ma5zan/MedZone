<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class vendor extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable = [
        'business_name',
        'mobile',
        'code',
        'speciality_id',
        'land_phone',
        'website',
        'rating',
    ];

    public function product()
    {
        return $this->hasMany(product::class);
    }

    public function order()
    {
        return $this->hasMany(order::class);
    }

    public function VendorSpeciality()
    {
        return $this->belongsTo(VendorSpeciality::class);
    }
    //change relationship to manytomany
    public function customer()
    {
        return $this->belongsToMany(customer::class);
    }
}
