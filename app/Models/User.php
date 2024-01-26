<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;
class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable, HasRoles, Billable;


//    protected $guard_name = 'api';

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }



    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'type',
        'email',
        'password',
        'rating',
        'company',
        'company_id',
        'blocked_subscription',
        'subscription_id',
        'login_blocked',
        'blocked',
        'reset_password_code',
        'subscription_id',
        'subscription_start',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function sellerInfo()
    {
        return $this->hasOne(UserInfo::class,'user_id','id');
    }

    public function sellerAddress()
    {
        return $this->hasMany(UserAddress::class,'user_id','id');
    }


    public function buyerInfo()
    {
        return $this->hasOne(UserInfo::class,'user_id','id');
    }

    public function buyerAddress()
    {
        return $this->hasMany(UserAddress::class,'user_id','id');
    }

    public function info()
    {
        return $this->hasOne(UserInfo::class,'user_id','id');
    }

    public function address()
    {
        return $this->hasMany(UserAddress::class,'user_id','id');
    }

     public function card()
    {
        return $this->hasMany(UserCard::class,'user_id','id');
    }

    public function event()
    {
        return $this->hasMany(UserEvanet::class,'user_id','id');
    }

    public function product()
    {
        return $this->hasMany(Product::class,'user_id','id');
    }

    public function auction()
    {
        return $this->hasMany(ProductAuction::class,'user_id','id');
    }

    public function verify()
    {
        return $this->hasMany(ProductError::class,'user_id','id');
    }
    public function subscription()
    {
        return $this->belongsTo(Subscription::class, 'subscription_id', 'id');
    }

    public function ordersSeller()
    {
        return $this->hasMany(Order::class,'seller_id','id');
    }
    public function ordersBuyer()
    {
        return $this->hasMany(Order::class,'buyer_id','id');
    }

    public function ordersOfferSeller()
    {
        return $this->hasMany(OrderOffer::class,'seller_id','id');
    }
    public function ordersOfferBuyer()
    {
        return $this->hasMany(OrderOffer::class,'buyer_id','id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function rating()
    {
        return $this->hasMany(UserRating::class,'user_id','id');
    }


    public function ratingCompany()
    {
        return $this->hasMany(UserRating::class,'company_id','id');
    }


}
