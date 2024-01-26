<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAuction extends Model
{
    use HasFactory;


    protected $table = 'product_auctions';
    protected $fillable = [
        'user_id',
        'product_id',
        'price',
        'status',
        'status_finish',
        'status_winner',
        'status_buy',
    ];

    public function company()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id','id');
    }

}
