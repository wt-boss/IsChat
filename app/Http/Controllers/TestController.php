<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function watch(Request $request){
        return response()->json(['status'=>'online', 'count'=>$request->count] , 200);
    }
}
