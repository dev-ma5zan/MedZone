<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class order extends Model
{
    use HasFactory;

     use SoftDeletes;

    protected $fillable = [
        'status',
        'code',
        'customer_id',
        'user_id',
        'products',
    ];

    protected $casts = [
        'products' => 'json',
    ];

    public function customer()
    {
        return $this->belongsTo(customer::class);
    }

    public function user()
    {
        return $this->belongsTo(user::class);
    }

    public function product()
    {
      return $this->belongsTo(product::Class);
    }

}
