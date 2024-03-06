<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Music;
use App\Http\Resources\UserResource;
use App\Http\Resources\MusicResource;
use App\Models\UserGenre;
use App\Models\UserInterest;
use App\Models\UserHistory;
use App\Models\UserPlaylist;
use Illuminate\Support\Arr;


class UserProfileController extends Controller
{
    
    public function show($id){
        $userProfile = User::with('genres','interest','history.music','subscription')->find($id);
        return new UserResource($userProfile);  
    }

    public function update(Request $request, $id){

        // \Log::debug("update profile");
        // \Log::debug($request->all());

        $userProfile = User::find($id);
        $userProfile->name =  $request->name;
        $userProfile->email =  $request->email;
        $userProfile->phone =  $request->phone;
        $userProfile->address1 =  $request->address1;
        $userProfile->address2 =  $request->address2;
        $userProfile->address3 =  $request->address3;
        $userProfile->postcode =  $request->postcode;
        $userProfile->city =  $request->city;
        $userProfile->state =  $request->state;
        $userProfile->save();

        $this->setGenres($request, $userProfile);
        $this->setInterest($request, $userProfile);
        $this->setHistory($request, $userProfile);
        $this->setUserPlaylist($request, $userProfile);


        return new UserResource($userProfile);
    }

    public function lookup()
    {
        $interestData = Music::get();

        return new MusicResource($interestData);
    }

    private function setGenres($request, $userProfile)
    {
        $genres = Arr::wrap($request->input('selectedGenres'));
        $genres = array_filter($genres);

        if ($genres) {
            // remove
            UserGenre::where('user_id', $userProfile->id)
                ->when($genres, function ($query) use ($genres) {
                    return $query->whereNotIn('genre', $genres);
                })
                ->delete();

            $existingGenres = UserGenre::where('user_id', $userProfile->id)->pluck('genre')->toArray();

            $genresToAdd = array_diff($genres, $existingGenres);
            
            //add new
            foreach ($genresToAdd as $new) {
                $genre = new userGenre;
                $genre->genre = $new;
                $genre->user_id = $userProfile->id;
                $genre->save();
            }
        } else {
            UserGenre::where('user_id', $userProfile->id)
                ->delete();
        }

        return $userProfile;
    }

    private function setInterest($request, $userProfile)
    {
        $interest = Arr::wrap($request->input('selectedInterests'));
        $interest = array_filter($interest);

        if ($interest) {
            // remove
            userInterest::where('user_id', $userProfile->id)
                ->when($interest, function ($query) use ($interest) {
                    return $query->whereNotIn('artist', $interest);
                })
                ->delete();

            $existingInterests = userInterest::where('user_id', $userProfile->id)->pluck('artist')->toArray();

            $interestToAdd = array_diff($interest, $existingInterests);
            
            //add new
            foreach ($interestToAdd as $new) {
                $interest = new userInterest;
                $interest->artist = $new;
                $interest->user_id = $userProfile->id;
                $interest->save();
            }
        } else {
            userInterest::where('user_id', $userProfile->id)
                ->delete();
        }

        return $userProfile;
    }

    private function setHistory($request, $userProfile)
    {
        $history = Arr::wrap($request->input('selectedHistory'));
        $history = array_filter($history);

        if ($history) {

            $musicIds = Music::whereIn('name', $history)->pluck('id')->toArray();

            // remove
            UserHistory::where('user_id', $userProfile->id)
                ->when($musicIds, function ($query) use ($musicIds) {
                    return $query->whereNotIn('music_id', $musicIds);
                })
                ->delete();

            $existingMusic = UserHistory::where('user_id', $userProfile->id)->pluck('music_id')->toArray();

            $musicToAdd = array_diff($musicIds, $existingMusic);
            
            //add new
            foreach ($musicToAdd as $new) {
                $history = new UserHistory();
                $history->music_id = $new;
                $history->user_id = $userProfile->id;
                $history->save();
            }
        } else {
            UserHistory::where('user_id', $userProfile->id)
                ->delete();
        }

        return $userProfile;
    }

    private function setUserPlaylist($request, $userProfile)
    {

        $deleteOldUserPlaylist = UserPlaylist::where('user_id',$userProfile->id)->delete();

        $userGenre = UserGenre::where('user_id', $userProfile->id)->pluck('genre')->toArray();
        $userInterest = UserInterest::where('user_id', $userProfile->id)->pluck('artist')->toArray();
        $userHistory = UserHistory::where('user_id', $userProfile->id)->pluck('music_id')->toArray();


        if($userGenre)
        {
            foreach($userGenre as $genre){
                $music = Music::where('genre', $genre)->pluck('id')->toArray();
                foreach($music as $m){
                    $userPlaylist = new UserPlaylist();
                    $userPlaylist->music_id = $m;
                    $userPlaylist->user_id = $userProfile->id;
                    $userPlaylist->save();
                }
            }
        }

        if($userInterest)
        {
            foreach($userInterest as $interest){
                    $music = Music::where('singer', $interest)->pluck('id')->toArray();
                    foreach($music as $m){

                        $existingEntry = UserPlaylist::where('music_id', $m)
                                        ->where('user_id', $userProfile->id)
                                        ->exists();

                        // If the music_id doesn't exist in the UserPlaylist, create a new entry
                        if (!$existingEntry) {
                            $userPlaylist = new UserPlaylist();
                            $userPlaylist->music_id = $m;
                            $userPlaylist->user_id = $userProfile->id;
                            $userPlaylist->save();
                        }
                }
            }
        }

        if($userHistory)
        {
            foreach($userHistory as $history){
    
                $existingEntry = UserPlaylist::where('music_id', $history)
                                ->where('user_id', $userProfile->id)
                                ->exists();

                // If the music_id doesn't exist in the UserPlaylist, create a new entry
                if (!$existingEntry) {
                    $userPlaylist = new UserPlaylist();
                    $userPlaylist->music_id = $history;
                    $userPlaylist->user_id = $userProfile->id;
                    $userPlaylist->save();
                }
            }
        
        }


        return $userProfile;
    }

}
