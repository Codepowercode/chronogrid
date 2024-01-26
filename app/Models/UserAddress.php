<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    use HasFactory;


    protected $table = 'user_addresses';

    protected $fillable = [
        'user_id',

        'address_1',
        'address_2',
        'city',
        'state',
        'postal_code',
        'type',

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function offer()
    {
        return $this->hasOne(OrderOffer::class,'address_id','id');
    }

}
