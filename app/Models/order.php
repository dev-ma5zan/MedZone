<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory;

     use SoftDeletes;

    protected $fillable = [
        'status',
        'code',
        'customer_id',
        'user_id',
        'products',
        'total',
    ];

    protected $casts = [
        'products' => 'json',
    ];

    public function Customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function Product()
    {
      return $this->belongsTo(Product::Class);
    }

}
