<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPlaylist extends Model
{
    use HasFactory;

    public function music(){
        return $this->hasOne(Music::class, 'id', 'music_id');
    }
}
