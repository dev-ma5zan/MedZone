<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class contract extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable = [
        'code',
        'vendor_id',
        'document',
    ];

    public function vendor()
    {
        return $this->belongsTo(vendor::class);
    }
}
