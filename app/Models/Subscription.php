<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $table = 'subscription';

    protected $fillable = [
        'name',
        'price',
    ];

    public function user()
    {
        return $this->hasOne(User::class,'subscription_id','id');
    }

}
