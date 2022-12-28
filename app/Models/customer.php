<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class customer extends Model
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
    ];

    public function order()
    {
        return $this->hasMany(order::class);
    }

    public function offer()
    {
        return $this->belongsTo(offer::class);
    }

    public function review()
    {
        return $this->hasMany(review::class);
    }

    public function CustomerSpeciality()
    {
        return $this->belongsTo(CustomerSpeciality::class);
    }

    public function activities()
    {
        return $this->belongsTo(activities::class);
    }

    public function area()
    {
        return $this->belongsTo(area::class);
    }

    public function sector()
    {
        return $this->belongsTo(sector::class);
    }

    public function SubAddress()
    {
        return $this->belongsTo(SubAddress::class);
    }

    public function street()
    {
        return $this->belongsTo(street::class);
    }

    public function BusinessHours()
    {
        return $this->belongsTo(BusinessHours::class);
    }

    public function vendor()
    {
        return $this->belongsToMany(vendor::class);
    }

    public function PreferredBuyingMethod()
    {
        return $this->belongsTo(PreferredBuyingMethod::class);
    }

    public function insurance()
    {
        return $this->belongsTo(insurance::class);
    }

    public function LocationType()
    {
        return $this->belongsTo(LocationType::class);
    }

    public function staff()
    {
        return $this->belongsTo(staff::class);
    }

    public function size()
    {
        return $this->belongsTo(size::class);
    }

    public function decor()
    {
        return $this->belongsTo(decor::class);
    }

    public function power()
    {
        return $this->belongsTo(power::class);
    }
}
