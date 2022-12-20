<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class area extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable = [
        'name',
    ];

    public function sector()
    {
        return $this->hasMany(sector::class);
    }

    public function customer()
    {
        return $this->belongsTo(customer::class);
    }
}
