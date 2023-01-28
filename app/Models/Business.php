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

    public function photos()
    {
        return $this->hasMany(BusinessPhoto::class, 'business_id', 'id');
    }

    public function scopeFindData($query, $id){
        return $query->where(function($q2) use($id){
            $q2->where('id', $id);
            $q2->orWhere('alias', $id);
        });
    }

     /**
     * Get the business's phone number action.
     *
     * @param  string  $value
     * @return string
     */
    public function getPhoneActionAttribute($value)
    {
        return '+62'.str_replace(["(0","(",")","-"," "],'', $this->phone);
    }

     /**
     * Get the business's phone number action.
     *
     * @param  string  $value
     * @return string
     */
    public function getDisplayPriceAttribute($value)
    {
        $response = '';
        for($i=1; $i<=$this->price; $i++){
            $response.='$';
        }

        return $response;
    }
}
