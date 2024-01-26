<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductError extends Model
{
    use HasFactory;

    protected $table = 'product_errors';
    protected $fillable = [
        'user_id',
        'error',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

}
