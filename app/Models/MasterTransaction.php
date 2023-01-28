<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterTransaction extends Model
{
    use HasFactory;

    public function businesses()
    {
        return $this->belongsToMany(Businesses::class, 'business_transactions', 'transaction_id', 'business_id');
    }
}
