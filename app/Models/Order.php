<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table='orders';

    protected $fillable=[
        'product_id',
        'buyer_id',
        'seller_id',
        'offer_id',
        'quantity',
        'price',
        'original_price',
        'type',
        'track_number',
        'delivery',
        'shipping',
        'history',
        'pdf',
        'status',
        'transfer_status',
    ];


    public static function typeOfDeliveryOrder($key = null)
    {
        $status = [
            'cancelled', //
            'pending', // zakaz@ @ndunvela
            'shipped', // champina
            'approved', // hasela hastatuma
            'didnt_shipped', // chi uxarkel
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


    public static function transferStatusOrder()
    {
        return [
            'payment_sent',
            'payment_approved',
            'payment_canceled',
            ];
    }

    public function buyer()
    {
        return $this->belongsTo(User::class,'buyer_id','id');
    }
    public function seller()
    {
        return $this->belongsTo(User::class,'seller_id','id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id','id');
    }

    public function offer()
    {
        return $this->belongsTo(OrderOffer::class,'offer_id','id');
    }

}
