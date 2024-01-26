<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    protected $table = 'listings';
    protected $fillable = [
        'brand',
        'model',
        'metal',
        'description',
        'description1',
        'full_description',
        'model_text',
        'model_description',
        'size',
        'bezel_material',
        'bezel_type',
        'bezel_size',
        'band_material',
        'band_type',
        'dial',
        'dial_markers',
        'retail',
        'path',
        'year',
        'hash',
        'json',
    ];
}
