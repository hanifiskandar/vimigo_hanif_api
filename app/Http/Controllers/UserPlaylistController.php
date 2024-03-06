<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Music;
use App\Models\UserPlaylist;
use App\Http\Resources\UserPlaylistResource;


class UserPlaylistController extends Controller
{
    public function show($id){
        $userPlaylist = UserPlaylist::with('music')->where('user_id',$id)->get();
        return new UserPlaylistResource($userPlaylist);  
    }
}
