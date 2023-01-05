<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contract extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable = [
        'code',
        'vendor_id',
        'documents',
    ];

    protected $casts = [
        'documents' => 'json',
    ];

    public function Vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
}
