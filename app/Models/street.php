<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class street extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable = [
        'name',
        'sub_address_id',
    ];

    public function SubAddress()
    {
        return $this->belongsTo(SubAddress::class);
    }
}