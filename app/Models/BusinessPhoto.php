<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessPhoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'path'
    ];

    public function business()
    {
        return $this->belongsTo(Business::class, 'business_id');
    }
}
