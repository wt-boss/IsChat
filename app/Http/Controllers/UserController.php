<?php

namespace App\Http\Controllers;

use App\Events\UserStatusEvent;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Cache;

class UserController extends Controller
{
    public function handleStatus(Request $request){
      
        $user = User::find($request->id);
        if(Cache::has('user-is-online-'.$user->id)){
            return response()->json(['user_status'=>'ligne'],200);
        }
        else{
            $user->status = 'horsLine';
            $user->save();
            return response()->json(['user_status'=>'horsLine'],200);
        }
        ;

    }
}
