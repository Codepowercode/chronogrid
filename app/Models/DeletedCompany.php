<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeletedCompany extends Model
{
    use HasFactory;


    protected $table = 'deleted_companies';

    protected $fillable = [
        'position_id',
        'type',
        'name',
        'email',
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
}
