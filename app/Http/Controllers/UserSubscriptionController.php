<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserSubscription;
use App\Http\Resources\UserSubscriptionResource;

class UserSubscriptionController extends Controller
{
    public function update(Request $request, $id){

        $userSubscription = UserSubscription::where('user_id',$id)->first();
        
        if($userSubscription){

            $userSubscription->type = $request->type;
            $userSubscription->from_month = $request->from_month;
            $userSubscription->to_month = $request->to_month;
            $userSubscription->save();
        }
        else
        {
            $userSubscription = new UserSubscription();
            $userSubscription->user_id = $id;
            $userSubscription->type = $request->type;
            $userSubscription->from_month = $request->from_month;
            $userSubscription->to_month = $request->to_month;
            $userSubscription->save();

        }

        return new UserSubscriptionResource($userSubscription);

    }
}
