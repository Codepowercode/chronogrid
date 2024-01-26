<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $fillable = [
        'user_id',
        'brand',
        'description',
        'model_number',
        'model',
        'color',
        'size',
        'metal',
        'bezel_size',
        'bezel_type',
        'bezel_metal',
        'bracelet_type',
        'condition',
        'more_condition',
        'band',
        'dial_type',
        'note',
        'price',
        'min_offer_price',
        'year',
        'quantity',
        'shipping',
        'excel',
        'auction',
        'auction_price',
        'auction_min_bid',
        'auction_start',
        'auction_end',
        'status',
        'auction_status_finish',
        'serial_number',
    ];

    public static function moreCondition($more_condition = null, $may_arr = null)
    {
        // -----------------ATTENTION-----------------
        //  in no case do not change the place or meaning
        // used: ProductService->update(), ProductService->create(), ProductService->createCSV(), ListingService->getListingById()


        $arr = [
            0 => 'Watch and Box',
            1 => 'Watch and paper (no box)',
            2 => 'Complete',
            3 => 'Watch Only',
        ];
        if ($more_condition || $may_arr){
            $arr = [
                'yes_no' => 'Watch and Box',
                'no_yes' => 'Watch and paper (no box)',
                'yes_yes' => 'Complete',
                'no_no' => 'Watch Only',
            ];
        }
        if ($more_condition){
            $arr =  explode('_', array_search($more_condition, $arr));
            $arrOut['box'] = $arr[0];
            $arrOut['papers'] = $arr[1];
            $arr = $arrOut;
        }
        return $arr;

//        return [
//            0 =>'papers & box',
//            1 =>'no papers & no box',
//            2 =>'papers',
//            3 =>'box',
//            4 =>'no papers',
//            5 =>'no box',
//        ];
    }

    public static function condition()
    {
        // -----------------ATTENTION-----------------
        //  in no case do not change the place or meaning
        // used: ProductService->update(), ProductService->create()

        return [
            0 =>'new',
            1 =>'used',
        ];
    }

    public static function settingsFilter()
    {
        return [
            0 =>'waiting',
            1 =>'approved',
            2 =>'rejected',
        ];
    }


    public static function scopeGetProductForView(\Illuminate\Database\Eloquent\Builder $query)
    {
        return $query->with('images', 'company')->where('status', 1)->where('auction', 0)->where('blocked_product', 1);
    }

    public function company()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class,'product_id','id');
    }

    public function auctionHistory()
    {
        return $this->hasMany(ProductAuction::class,'product_id','id');
    }

    public function order()
    {
        return $this->hasMany(Order::class,'product_id','id');
    }

    public function offer()
    {
        return $this->hasOne(Order::class,'product_id','id');
    }
}
