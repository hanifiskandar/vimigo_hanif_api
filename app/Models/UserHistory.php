<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserHistory extends Model
{
    use HasFactory;

    protected $table = 'user_history';

     public function music(){
        return $this->hasOne(Music::class, 'id', 'music_id');
    }

}
