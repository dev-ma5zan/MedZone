<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vendor extends Model
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

    public function Product()
    {
        return $this->hasMany(Product::class);
    }

    public function Order()
    {
        return $this->hasMany(Order::class);
    }

    public function VendorSpeciality()
    {
        return $this->belongsTo(VendorSpeciality::class);
    }
    
    public function Customer()
    {
        return $this->belongsToMany(Customer::class);
    }
}
