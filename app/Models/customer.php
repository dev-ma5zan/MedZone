<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use Notifiable;

    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'full_name',
        'business_name',
        'mobile',
        'land_phone',
        'documents',
        'customer_speciality_id',
        'activity_id',
        'area_id',
        'sector_id',
        'sub_address_id',
        'street_id',
        'detailed_address',
        'business_hours_id',
        'vendor_id',
        'preferred_buying_method_id',
        'insurance_id',
        'location_type_id',
        'staff_id',
        'size_id',
        'decor_id',
        'power_id',
        'behavior',
        'notes',
        'rating',
        'secretary_name',
        'secretary_mobile',
    ];

    protected $casts = [
        'documents' => 'json',
        'vendor_id' => 'array',
    ];

    public function Order()
    {
        return $this->hasMany(order::class);
    }

    public function Offer()
    {
        return $this->belongsTo(Offer::class);
    }

    public function Review()
    {
        return $this->hasMany(Review::class);
    }

    public function CustomerSpeciality()
    {
        return $this->belongsTo(CustomerSpeciality::class);
    }

    public function Activities()
    {
        return $this->belongsTo(Activities::class);
    }

    public function Area()
    {
        return $this->belongsTo(Area::class);
    }

    public function Sector()
    {
        return $this->belongsTo(Sector::class);
    }

    public function SubAddress()
    {
        return $this->belongsTo(SubAddress::class);
    }

    public function Street()
    {
        return $this->belongsTo(Street::class);
    }

    public function BusinessHours()
    {
        return $this->belongsTo(BusinessHours::class);
    }

    public function Vendor()
    {
        return $this->belongsToMany(Vendor::class);
    }

    public function PreferredBuyingMethod()
    {
        return $this->belongsTo(PreferredBuyingMethod::class);
    }

    public function Insurance()
    {
        return $this->belongsTo(Insurance::class);
    }

    public function LocationType()
    {
        return $this->belongsTo(LocationType::class);
    }

    public function Staff()
    {
        return $this->belongsTo(Staff::class);
    }

    public function Size()
    {
        return $this->belongsTo(Size::class);
    }

    public function Decor()
    {
        return $this->belongsTo(Decor::class);
    }

    public function Power()
    {
        return $this->belongsTo(Power::class);
    }
}
