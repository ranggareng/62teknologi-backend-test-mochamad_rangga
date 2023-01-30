<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessOperational extends Model
{
    use HasFactory;

    protected $fillable = [
        'day', 'start', 'end', 'is_overnight'
    ];

    public function business()
    {
        return $this->belongsTo(Business::class, 'business_id');
    }
}
