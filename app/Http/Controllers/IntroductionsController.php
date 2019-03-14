<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Auth;
use App\Activity;
use App\Apply;
use App\Approval;
use App\Gauge;
use App\Goal;
use App\Introduction;
use App\Oneword;
use App\Profile;
use App\User;


class IntroductionsController extends Controller
{
    // 最初に表示されるページ
    public function index() {
        $auths      = Auth::user();
        $activities = Gauge::where('user_id',Auth::user()->id)->latest()->paginate(3);
        $comment1   = Introduction::where('user_id',Auth::user()->id)->where('term','1')->latest()->first();
        $comment2   = Introduction::where('user_id',Auth::user()->id)->where('term','2')->latest()->first();
        $comment3   = Introduction::where('user_id',Auth::user()->id)->where('term','3')->latest()->first();
        $goals      = Goal::where('user_id',$auths->id)->latest()->paginate(3);
        $follow     = DB::table('approvals')->where('user_id',$auths->id)->where('status',2)->count();
        $follower   = DB::table('approvals')->where('to_who' ,$auths->id)->where('status',2)->count();
        
        $oneword    = Oneword::where('user_id',Auth::user()->id)->latest()->first();
        $profiles   = Profile::where('user_id',Auth::user()->id)->latest()->first();
        $titles     = Activity::where('user_id',Auth::user()->id)->latest()->paginate(5);
        // $comments = Introduction::where('user_id',Auth::user()->id)->latest()->paginate(3);
        
        // ゲージ用-------------------------------
        // ▲languageを数字にして,for文で回さないといけない
        $user_coins = Gauge::where('user_id',Auth::user()->id)->latest()->first();
    
        // for ($i=0; $i<3; $i++) {
        //     $GLOBALS["i"] = $i;
        //     $array_clubs[$i] = Gauge::whereIn('id', function($query) { $query->select(DB::raw('MAX(id) As id'))->from('gauges')->groupBy('language','user_id')->where('language',$GLOBALS["i"]+1); })->get();
        //     $clubs[ $GLOBALS["i"]+1 ]   = $array_clubs[ $GLOBALS["i"] ];
        // }
    
        $swims = Gauge::whereIn('id', function($query) {
          $query->select(DB::raw('MAX(id) As id'))->from('gauges')->groupBy('language','user_id')->where('language','SWIM'); 
        })->get();
        
        $bikes = Gauge::whereIn('id', function($query) {
          $query->select(DB::raw('MAX(id) As id'))->from('gauges')->groupBy('language','user_id')->where('language','BIKE'); 
        })->get();
        
        $runs = Gauge::whereIn('id', function($query) {
          $query->select(DB::raw('MAX(id) As id'))->from('gauges')->groupBy('language','user_id')->where('language','RUN'); 
        })->get();
        // ゲージ用-------------------------------

        return view('comments', [
            'auths'       => $auths,
            'activities'  => $activities,
            'comment1'    => $comment1,
            'comment2'    => $comment2,
            'comment3'    => $comment3,
            'follow'      => $follow,
            'follower'    => $follower,
            'goals'       => $goals,
            'oneword'     => $oneword,
            'profiles'    => $profiles,
            'titles'      => $titles,
            
            'user_coins'  => $user_coins,
            // 'clubs'      => $clubs,
            'swims'       => $swims,
            'bikes'       => $bikes,
            'runs'        => $runs,
        ]);
    }
    // COMMITMENTページ------------------------------------------------------
    public function term() {
        $auths    = Auth::user();
        $comments = Introduction::where('user_id',Auth::user()->id)->latest()->paginate(5);
        
        return view('committerm', [
            'auths'    => $auths,
            'comments' => $comments
        ]);
    }
    // 登録-------
    public function store(Request $request) {
        // バリデーション
        $this->validate($request,[
            'comment'   => 'required | max:35',
            'commit_at' => 'required'
        ]);
        
        // Eloquent モデル
        $comments = new Introduction;
        $comments->user_id   = Auth::user()->id;
        $comments->comment   = $request->comment;
        $comments->commit_at = $request->commit_at;
        $comments->term      = $request->term;
        $comments->save(); 
        return redirect('/term');
    }
    // 更新画面-------
    public function edit(Introduction $comments) {
        $comment = Introduction::where('id',$comments);
        return view('commentsedit', ['comment' => $comments]);
    }
    // 更新処理------------------------------------------
    public function update(Request $request) {
        // バリデーション
        $this->validate($request,[
            'comment' => 'required | max:255',
        ]);
        
        // Eloquent モデル
        $comments          = Introduction::where('id',$request->id)->first();
        $comments->comment = $request->comment;
        $comments->save();   //「/」ルートにリダイレクト 
        return redirect('/term');
    }
    // 削除処理-------------------------------------------
    public function destroy(Introduction $comment) {
        $comment->delete();
        return redirect('/term');
    }
    
    // 友達登録-------
    public function create(Request $request) {
        
        \App\Approval::create([ 
            
        'user_id' => $request->users_id,
        'to_who'  => $request->to_whos,
        'status'  => $request->status
        
        ]);
        return response(['status'=>'success'],200);
    }
    // Followリスト
    public function follow() {
        
        $auths   = Auth::user();
        $follows = Approval::where('user_id',$auths->id)->where('status',2)->get();
        
        return view('followlist', [
            'auths'     => $auths,
            'follows'   => $follows,
        ]);
    }
    // Followerリスト
    public function follower() {
        $auth       = Auth::user();
        $approvals  = Approval::latest()->get();
        $followers  = Approval::where('to_who',$auth->id)->get();
        
        return view('followerlist', [
            'auth'      => $auth,
            'approvals' => $approvals,
            'followers' => $followers
        ]);
    }
}