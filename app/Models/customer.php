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

    public function order()
    {
        return $this->hasMany(order::class);
    }

    public function CustomerSpeciality()
    {
        return $this->hasMany(CustomerSpeciality::class);
    }

    public function activities()
    {
        return $this->hasMany(activities::class);
    }

    public function area()
    {
        return $this->hasMany(area::class);
    }

    public function BusinessHours()
    {
        return $this->hasMany(BusinessHours::class);
    }

    public function vendor()
    {
        return $this->hasMany(vendor::class);
    }

    public function PreferredBuyingMethod()
    {
        return $this->hasMany(PreferredBuyingMethod::class);
    }

    public function insurance()
    {
        return $this->hasMany(insurance::class);
    }

    public function LocationType()
    {
        return $this->hasMany(LocationType::class);
    }

    public function staff()
    {
        return $this->hasMany(staff::class);
    }

    public function size()
    {
        return $this->hasMany(size::class);
    }

    public function decor()
    {
        return $this->hasMany(decor::class);
    }

    public function power()
    {
        return $this->hasMany(power::class);
    }
}
