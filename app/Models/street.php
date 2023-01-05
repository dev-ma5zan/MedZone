<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Street extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable = [
        'name',
        'sub_address_id',
        'weight',
    ];

    public function SubAddress()
    {
        return $this->belongsTo(SubAddress::class);
    }

    public function Customer()
    {
        return $this->hasMany(Customer::class);
    }
}
