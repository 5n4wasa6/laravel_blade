<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Auth;
use App\Activity;
use App\ActivityComment;
use App\Apply;
use App\Approval;
use App\Goal;
use App\Gauge;
use App\Introduction;
use App\Oneword;
use App\Profile;
use App\User;

class NotificationController extends Controller
{
    // 最初に表示されるページ
    public function index() {
        $auth      = Auth::user();
        $appies    = Apply::latest()->get();
        $approvals = Approval::where('to_who',$auth->id)->where('status',1)->latest()->get();
        
        $profile_tls = Profile::whereIn('id', function($query) { $query->select(DB::raw('MAX(id) As id'))->from('profiles')->groupBy('user_id'); })->get();
        
        return view('notification', [
            'auth'      => $auth,
            'applies'   => $appies,
            'approvals' => $approvals,
            'profile_tls' => $profile_tls,
        ]);
    }
    // 承認-------
    public function approval(Request $request) {
        
        // Eloquent モデル
        $approvals = Approval::where('id',$request->id)->first();
        
        $approvals->user_id = $request->user_id;
        $approvals->to_who  = $request->to_who;
        $approvals->status  = $request->status;
        $approvals->save(); 
        return redirect('/notification');
        
    }
    // 削除処理-------------------------------------------
    public function destroy(Approval $approval) {
        $approval->delete();
        return redirect('/notification');
    }
    
    
    
    // 名前押下後の画面-------------------------------------------
    public function show(Apply $applies) {
        $auth       = Auth::user();
        $user       = Gauge::where('id',$applies);
        $activities = Gauge::where('user_id',$applies->user_id)->latest()->paginate(3);
        $apply      = DB::table('applies')->where('user_id',$auth->id)->where('to_who',$applies->user_id)->latest()->first();
    
        $comment1   = Introduction::where('user_id',$applies->user_id)->where('term','1')->latest()->first();
        $comment2   = Introduction::where('user_id',$applies->user_id)->where('term','2')->latest()->first();
        $comment3   = Introduction::where('user_id',$applies->user_id)->where('term','3')->latest()->first();
        $follow     = DB::table('approvals')->where('user_id',$applies->user_id)->where('status',2)->count();
        $follower   = DB::table('approvals')->where('to_who' ,$applies->user_id)->where('status',2)->count();
        $goals      = Goal::where('user_id',$applies->user_id)->latest()->paginate(3);
        $oneword    = Oneword::where('user_id',$applies->user_id)->latest()->first();
        $profile    = Profile::where('user_id',$applies->user_id)->latest()->first();
        $titles     = Activity::where('user_id',$applies->user_id)->latest()->paginate(5);
        
        $user_coins = Gauge::where('user_id',$applies->user_id)->latest()->first();
        $swims = Gauge::whereIn('id', function($query) {
          $query->select(DB::raw('MAX(id) As id'))->from('gauges')->groupBy('language','user_id')->where('language','SWIM'); 
        })->get();
        $bikes = Gauge::whereIn('id', function($query) {
          $query->select(DB::raw('MAX(id) As id'))->from('gauges')->groupBy('language','user_id')->where('language','BIKE'); 
        })->get();
        $runs = Gauge::whereIn('id', function($query) {
          $query->select(DB::raw('MAX(id) As id'))->from('gauges')->groupBy('language','user_id')->where('language','RUN'); 
        })->get();
        
        return view('commentshow', [
            'auth' => $auth,
            'user' => $applies,
            
            'activities' => $activities,
            'apply'      => $apply,
            'comment1'   => $comment1,
            'comment2'   => $comment2,
            'comment3'   => $comment3,
            
            'follow'      => $follow,
            'follower'    => $follower,
            'goals'      => $goals,
            'oneword'    => $oneword,
            'profile'    => $profile,
            'titles'     => $titles,
            
            'user_coins' => $user_coins,
            'swims'      => $swims,
            'bikes'      => $bikes,
            'runs'       => $runs
        ]);
    }
}
