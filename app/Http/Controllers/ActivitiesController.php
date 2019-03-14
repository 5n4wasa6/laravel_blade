<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Auth;
use App\Activity;
use App\ActivityComment;
use App\Apply;
use App\Gauge;
use App\Goal;
use App\Introduction;
use App\Oneword;
use App\Profile;

class ActivitiesController extends Controller
{
    public function index() {
        $auths  = Auth::user();
        $titles = Activity::where('user_id',Auth::user()->id)->latest()->paginate(5);
        $alls   = Activity::latest()->get();
        
        $user_coins = Gauge::where('user_id',Auth::user()->id)->latest()->first();
        
        $swims = Gauge::whereIn('id', function($query) {
          $query->select(DB::raw('MAX(id) As id'))->from('gauges')->groupBy('language','user_id')->where('language','SWIM'); 
        })->get();
        
        $bikes = Gauge::whereIn('id', function($query) {
          $query->select(DB::raw('MAX(id) As id'))->from('gauges')->groupBy('language','user_id')->where('language','BIKE'); 
        })->get();
        
        $runs = Gauge::whereIn('id', function($query) {
          $query->select(DB::raw('MAX(id) As id'))->from('gauges')->groupBy('language','user_id')->where('language','RUN'); 
        })->get();
        
        return view('activities', [
            'auths'  => $auths,
            'alls'   => $alls,
            'titles' => $titles,
            
            'user_coins' => $user_coins,
            'swims'      => $swims,
            'bikes'      => $bikes,
            'runs'       => $runs
        ]);
    }
    // 登録---------------------------------------------
    public function store(Request $request) {
        // バリデーション
        $this->validate($request,[
            'title'       => 'required| min:5 | max:255',
        ]);
        
        // 画像格納
        $file = $request->file('activity_img');
        if (!empty($file)) {
            $filename = $file->getClientOriginalName();
            $move = $file->move('./upload/',$filename);
        } else {
            $filename = "";
        }
        
        // Eloquent モデル
        $titles = new Activity;
        $titles->user_id       = Auth::user()->id;
        $titles->activity_at   = $request->activity_at;
        $titles->subject       = $request->subject;
        $titles->title         = $request->title;
        $titles->appeal        = $request->appeal;
        $titles->nextaction    = $request->nextaction;
        $titles->free          = $request->free;
        $titles->activity_img  = $filename;
        $titles->save();   //「/」ルートにリダイレクト 
        return redirect('/');
    }
    // 更新画面
    public function edit(Gauge $alls) {
        $title = Gauge::where('id',$alls);
        return view('activitiesedit', ['title' => $alls]);
    }
    // 更新処理-----------------------------------------
    public function update(Request $request) {
        // バリデーション
        // $this->validate($request,[
        //     'id'         => 'required',
        //     'title'       => 'required| min:5 | max:255',
        
        // 画像格納
        $file = $request->file('activity_img');
        if (!empty($file)) {
            $filename = $file->getClientOriginalName();
            $move = $file->move('./upload/',$filename);
        } else {
            $filename = "";
        }
        
        // Eloquent モデル
        $titles = GAUGE::where('id',$request->id)->first();
        // $titles->activity_at   = $request->activity_at;
        // $titles->subject       = $request->subject;
        // $titles->title         = $request->title;
        $titles->appeal        = $request->appeal;
        $titles->nextaction    = $request->nextaction;
        $titles->free          = $request->free;
        $titles->activity_img  = $filename;
        $titles->save();   //「/」ルートにリダイレクト 
        return redirect('/');
    }
    // 削除処理-------------------------------------------
    public function destroy(Activity $title) {
        $title->delete();
        return redirect('/activity');
    }
    // ディスカッションのコメント登録---------------------
    public function create(Request $request) { 
        // バリデーション
        $this->validate($request,[
            'activity_comment'  => 'required'
        ]);
        
        $discuss = new ActivityComment;
        $discuss->user_id          = Auth::user()->id;
        $discuss->post_id          = $request->post_id;
        $discuss->activity_comment = $request->activity_comment;
        $discuss->save();
        return redirect('/');
    }
    // グラフPage表示------------------------------------
    public function graph() {

        return view('activitygraph', [
            
        ]);
    }
    // 全記録表示
    public function record() {

        return view('activityrecord', [
            
        ]);
    }
    // 全記録表示
    public function look(Gauge $alls) {
        $comments = ActivityComment::where('post_id',$alls->id)->latest()->get();
        $title    = Gauge::where('id',$alls);
        
        return view('activitylook', [
            'comments' => $comments,
            'title'    => $alls
            ]);
    }
    // 名前押下後の画面-------------------------------------------
    public function show(Gauge $alls) {
        $auth       = Auth::user();
        $user       = Gauge::where('id',$alls);
        
        $activities = Gauge::where('user_id',$alls->user_id)->latest()->paginate(3);
        $apply      = DB::table('applies')->where('user_id',$auth->id)->where('to_who',$alls->user_id)->latest()->first();
    
        $comment1   = Introduction::where('user_id',$alls->user_id)->where('term','1')->latest()->first();
        $comment2   = Introduction::where('user_id',$alls->user_id)->where('term','2')->latest()->first();
        $comment3   = Introduction::where('user_id',$alls->user_id)->where('term','3')->latest()->first();
        $follow     = DB::table('approvals')->where('user_id',$alls->user_id)->where('status',2)->count();
        $follower   = DB::table('approvals')->where('to_who' ,$alls->user_id)->where('status',2)->count();
        $goals      = Goal::where('user_id',$alls->user_id)->latest()->paginate(3);
        $oneword    = Oneword::where('user_id',$alls->user_id)->latest()->first();
        
        $profile    = Profile::where('user_id',$alls->user_id)->latest()->first();
        $titles     = Activity::where('user_id',$alls->user_id)->latest()->paginate(5);
        
        $user_coins = Gauge::where('user_id',$alls->user_id)->latest()->first();
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
            'user' => $alls,
            
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