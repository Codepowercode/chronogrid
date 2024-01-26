<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserEvanet extends Model
{
    use HasFactory;

    protected $table='user_events';
    protected $fillable=[
        'user_id',
        'type',
        'action',
        'long_text',
        'send_mail',
        'additional',
        'additional_id',
        'is_read',
        'status',
    ];


    public static function eventType(){
        return [
            'order',
            'bid',
            'auction',
            'buy_new',
            'offer',
        ];
    }

    // ---type---
    // order
    // bid
    // auction
    // buy_new
    // offer

    // user/ member
    // user/ role

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
