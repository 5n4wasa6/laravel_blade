<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use App\Gauge;

class GaugesController extends Controller
{
    public function index() {
        return \App\Gauge::orderBy('id', 'desc')->get();
    }
    
    // メッセージを登録
    public function create(Request $request) { 
        
        \App\Gauge::create([ 
            
        'coin'         => $request->coin,
        'exp'          => $request->progress,
        'level'        => $request->level,
        'ttl'          => $request->ttl,
        'denominator'  => $request->denominator,
        'language'     => $request->language,
        
        'activity_at'  => $request->activity_at,
        'act_title'    => $request->act_title,
        'appeal'       => $request->appeal,
        'nextaction'   => $request->nextaction,
        'free'         => $request->free,
        'activity_img' => $request->activity_img,
        
        'user_id'      => $request->users_id
        ]);
        
        return response(['status'=>'success'],200);
        
    }
}
