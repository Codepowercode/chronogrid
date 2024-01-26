<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderOffer extends Model
{
    use HasFactory;

    protected $table='order_offers';

    protected $fillable=[
        'product_id',
        'buyer_id',
        'seller_id',
        'address_id',
        'type',
        'credit',
        'price',
        'quantity',
        'count_offer',
        'message',
        'shipping',
        'delivery',
        'status',
    ];


    public static function typeOfDeliveryOffer($key = null)
    {
        $status = [
            'approved',
            'pending',
            'rejected',
        ];

        if (in_array($key, $status)){
            $key = array_search($key, $status);
        }

        if ($key > -1){
            return $status[$key];
        }else{
            return $status;
        }

    }


    public function buyer()
    {
        return $this->belongsTo(User::class,'id','buyer_id');
    }

    public function seller()
    {
        return $this->belongsTo(User::class,'id','seller_id'); //,'id','seller_id'
    }

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id','id');
    }

    public function order()
    {
        return $this->hasOne(Order::class,'offer_id','id');
    }

    public function address()
    {
        return $this->belongsTo(UserAddress::class,'address_id','id');
    }

}
