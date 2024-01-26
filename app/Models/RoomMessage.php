<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomMessage extends Model
{
    use HasFactory;

    protected $table = 'room_messages';

    protected $fillable = [
        'name',
        'from_id',
        'to_id',
    ];

    public function message()
    {
        return $this->hasMany(Message::class);
    }

}
