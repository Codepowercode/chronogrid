<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRating extends Model
{
    use HasFactory;

    protected $table = 'user_ratings';

    protected $fillable = [
        'user_id',
        'company_id',
        'rating_payment_process',
        'rating_overall_experience',
        'rating_communication',
        'feed_back',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }

    public function company()
    {
        return $this->belongsTo(User::class, 'id', 'company_id');
    }



}
