<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUuid;
use App\Traits\Uuid;
use Cviebrock\EloquentSluggable\Sluggable;

class Business extends Model
{
    use HasFactory, HasUuid, Sluggable, Uuid;

    protected $fillable = [
        'name', 'alias', 'phone', 'address', 'latitude', 'longitude', 'price'
    ];

    protected $casts = [
        'address' => 'array'
    ];

    public function sluggable()
    {
        return [
            'alias' => [
                'source' => 'name'
            ]
        ];
    }

    public function categories()
    {
        return $this->belongsToMany(MasterCategory::class, 'business_categories', 'business_id', 'category_id');
    }

    public function transactions()
    {
        return $this->belongsToMany(MasterTransaction::class, 'business_transactions', 'business_id', 'transaction_id');
    }

    public function operationals()
    {
        return $this->hasMany(BusinessOperational::class, 'business_id', 'id');
    }
}
