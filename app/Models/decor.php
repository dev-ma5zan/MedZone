<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class decor extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable = [
        'name',
        'customer_id',
    ];

    public function customer()
    {
        return $this->belongsTo(customer::class);
    }
}
