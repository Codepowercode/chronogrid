<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    use HasFactory;

    protected $table = 'user_info';

    protected $fillable = [
        'user_id',
        'type',
        'type_section',
        'phone_number',
        'alt_phone_number',
        'website',
        'company_contact',
        'business_hours',

        'trade',

        'iwjg_member_number',
        'rapnet_member_number',
        'jbt_member_number',
        'poligon_member_number',
        'tawd',

        'about_company',
        'bank_information',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
