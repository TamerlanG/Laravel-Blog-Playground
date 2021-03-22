<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class RedisController extends Controller
{
    public function index(){
        return response()->json(['message' => Redis::get('secret')]);
    }

    public function set(Request $request){
        Redis::set('secret', $request['secret']);

        return response()->json(['message' => 'success']);
    }
}
