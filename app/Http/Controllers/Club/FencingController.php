<?php

namespace App\Http\Controllers\Club;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use App\Admin;
use App\Club;
use App\Clubchat;
use App\ClubId;
use App\Event;
use App\EventComment;
use App\Participate;
use App\Rule;
use App\Subject;


class FencingController extends Controller
{
    // フェンシング部 TOPページ (Discussページ)-----------------------------------------------------------------------
    public function fencing() {
        $auths        = Auth::user();
        $alls         = Club::where('club_id',2)->latest()->get();
        $comments     = Clubchat::where('club_id',2)->latest()->get();
        $members      = ClubId::where('club_id',3)->latest()->get();
        $users        = DB::table('club_ids')->where('club_id',2)->distinct()->count('user_id');
        $rules        = Club::orderBy('id','asc')->paginate(3);
        $titles       = Club::where('user_id',Auth::user()->id)->get();
        
        $main_manager = Admin::where('admin', 1)->where('club_id',2)->latest()->first();
        $sub_manager  = Admin::where('admin', 2)->where('club_id',2)->latest()->first();
        
        for ($i=0; $i<100; $i++) {
            $array_comment_sum[$i] = DB::table('clubchats')->where('post_id',$i+1)->count('body');
            $comment_sum[ $i+1 ]   = $array_comment_sum[ $i ];
        }
        
        return view('club/fencing/fencing', [
            'auths'       => $auths,
            'alls'        => $alls,
            'comments'    => $comments,
            'members'     => $members,
            'rules'       => $rules,
            'titles'      => $titles,
            'users'       => $users,
            
            'main_manager' => $main_manager,
            'sub_manager'  => $sub_manager,

            'comment_sum' => $comment_sum,

        ]);
    }
    // メンバー一覧ページ表示 ------------
    public function member() {
        $auths   = Auth::user();
        $users   = DB::table('club_ids')->where('club_id',2)->distinct()->count('user_id');
        $alls    = Club::where('club_id',2)->latest()->get();
        
        $main_manager = Admin::where('admin', 1)->where('club_id',2)->latest()->first();
        $sub_manager  = Admin::where('admin', 2)->where('club_id',2)->latest()->first();
        
        return view('club/fencing/fencingmember', [
            'alls'   => $alls,
            'auths'  => $auths,
            'users' => $users,
            
            'main_manager' => $main_manager,
            'sub_manager'  => $sub_manager
        ]);
    }
    // ディスカッション登録---------------
    public function discussion_store(Request $request) {
        // バリデーション
        $this->validate($request,[
            'body'  => 'required'
        ]);
        
        // 画像格納
        $file = $request->file('club_img');
        if (!empty($file)) {
            $filename = $file->getClientOriginalName();
            $move = $file->move('./upload/',$filename);
        } else {
            $filename = "";
        }
    
        // Eloquent モデル
        $titles = new Club;
        $titles->user_id     = Auth::user()->id;
        $titles->body        = $request->body;
        $titles->club_id     = $request->club_id;
        $titles->club_img    = $filename;
        $titles->save();    
        return redirect('/fencing');
    }
    // 編集画面-------------------------
    public function discussion_edit(Club $alls) {
        $all = Club::where('id',$alls);
        return view('club/fencing/fencingdiscussionedit', ['all' => $alls]);
    }
    // 編集処理--------------------------
    public function discussion_update(Request $request) {
        // バリデーション
        $this->validate($request,[
            'body'  => 'required'
        ]);
        // // 画像格納
        // $file = $request->file('goal_img');
        // if (!empty($file)) {
        //     $filename = $file->getClientOriginalName();
        //     $move = $file->move('./upload/',$filename);
        // } else {
        //     $filename = "";
        // }
        
        // Eloquent モデル
        $posts = Club::where('id',$request->id)->first();
        $posts->body         = $request->body;
        // $posts->fencing_img  = $filename;
        $posts->save();
        return redirect('/fencing');
    }
    // 削除処理-------------------------------------------
    public function discussion_destroy(CLub $all) {
        $all->delete();
        return redirect('/fencing');
    }
    // ディスカッションのコメント登録
    public function discussion_create(Request $request) { 
        // バリデーション
        $this->validate($request,[
            'body'  => 'required'
        ]);
        
        $discuss = new Clubchat;
        $discuss->user_id = Auth::user()->id;
        $discuss->post_id = $request->post_id;
        $discuss->club_id = $request->club_id;
        $discuss->body    = $request->body;
        $discuss->save();
        return redirect('/fencing');
    }
    
    // RULE -------------------------------------------------------------------------------------------------------
    // TOP表示 --------
    public function rule() {
        $alls   = Club::where('club_id',2)->latest()->get();
        $auths  = Auth::user();
        $admins = Admin::where('user_id',Auth::user()->id)->where('club_id',2)->latest()->get();
        $users  = DB::table('club_ids')->distinct()->count('user_id');
        $rules  = Rule::where('club_id',2)->orderBy('id', 'asc')->paginate(3);
        
        $main_manager = Admin::where('admin', 1)->where('club_id',2)->latest()->first();
        $sub_manager  = Admin::where('admin', 2)->where('club_id',2)->latest()->first();
       
        return view('club/fencing/fencingrule', [
            'admins' => $admins,
            'auths'  => $auths,
            'users'  => $users,
            'alls'   => $alls,
            'rules'  => $rules,
            
            'main_manager' => $main_manager,
            'sub_manager'  => $sub_manager
        ]);
    }
    // 登録----------
    public function rule_store(Request $request) {
        // バリデーション
        $this->validate($request,[
            'rule'  => 'required'
        ]);
    
        // Eloquent モデル
        $rules = new Rule;
        $rules->user_id   = Auth::user()->id;
        $rules->rule      = $request->rule;
        $rules->club_id   = $request->club_id;
        $rules->save();    
        return redirect('/fencing_rule');
    }
    // 編集画面--------
    public function rule_edit(Rule $rules) {
        $all = Rule::where('id',$rules);
        return view('club/fencing/fencingruleedit', ['rule' => $rules]);
    }
    // 編集処理--------
    public function rule_update(Request $request) {
        // バリデーション
        $this->validate($request,[
            'rule' => 'required',
        ]);
        // Eloquent モデル
        $rules = Rule::where('id',$request->id)->first();
        $rules->rule        = $request->rule;
        $rules->save();
        return redirect('/fencing_rule');
    }
    // 削除処理-------------------------------------------
    public function rule_destroy(Rule $rule) {
        $rule->delete();
        return redirect('/fencing_rule');
    }
    
    // 管理者権限ページ表示 -----------------------------------------------------------------------------------------
    public function admin() {
        $alls         = ClubId::where('club_id',2)->latest()->paginate(7);
        $auths        = Auth::user();
        $club_ids     = ClubId::where('user_id',Auth::user()->id)->latest()->get(); 
        $rules        = Rule::orderBy('id','asc')->paginate(3);
        $subjects     = Subject::latest()->get();
        $users        = DB::table('club_ids')->where('club_id',2)->distinct()->count('user_id');
        
        $admins       = Admin::where('user_id',Auth::user()->id)->latest()->get();
        $main_manager = Admin::where('admin', 1)->where('club_id',2)->latest()->first();
        $sub_manager  = Admin::where('admin', 2)->where('club_id',2)->latest()->first();
        
        for ($i=0; $i<100; $i++) {
            $array_admin_sum[ $i ] = DB::table('admins')->where('club_id',$i+1)->sum('admin');
            $admin_sum[ $i+1 ]     = $array_admin_sum[ $i ];
        }
        
        return view('club/fencing/fencingadmin', [
            'alls'      => $alls,
            'auths'     => $auths,
            'club_ids'  => $club_ids,
            'rules'     => $rules,
            'subjects'  => $subjects,
            'users'     => $users,
            
            'admins'       => $admins,
            'main_manager' => $main_manager,
            'sub_manager'  => $sub_manager,
            'admin_sum'    => $admin_sum 
        ]);
    }
    // 管理者権限登録-----------------------------------------------------------
    public function admin_store(Request $request) {
        
        // Eloquent モデル
        $admins = new Admin;
        $admins->user_id = Auth::user()->id;
        $admins->club_id = $request->club_id;
        $admins->admin   = $request->admin;
        $admins->save();    
        return redirect('/fencing_admin');
    }
    
    // EVENTページ表示 ----------------------------------------------------------------------------------------------------------------
    public function event() {
        $auths          = Auth::user();
        $alls           = ClubId::where('club_id',2)->latest()->get();
        $all_events     = Event::where('club_id',2)->latest()->get();
        $participates   = Participate::latest()->get();
        $users          = DB::table('club_ids')->distinct()->count('user_id');
        $event_comments = EventComment::where('club_id',2)->latest()->get();
        
        $main_manager = Admin::where('admin', 1)->where('club_id',2)->latest()->first();
        $sub_manager  = Admin::where('admin', 2)->where('club_id',2)->latest()->first();
        
        //本来はフェンシング部(各々の部活)に登録している人数分をcountしなければいけない-----
        for ($i=0; $i<100; $i++) {
            $array_go[$i] = DB::table('participates')->where('event_id',$i+1)->sum('go');
            $go[ $i+1 ]   = $array_go[ $i ];
            
            $array_undecided[$i] = DB::table('participates')->where('event_id',$i+1)->sum('undecided');
            $undecided[ $i+1 ]   = $array_undecided[ $i ];
            
            $array_ungo[$i] = DB::table('participates')->where('event_id',$i+1)->sum('ungo');
            $ungo[ $i+1 ]   = $array_ungo[ $i ];
        }
        
        return view('club/fencing/fencingevent', [
            'auths'          => $auths,
            'alls'           => $alls,
            'all_events'     => $all_events, 
            'participates'   => $participates,
            'users'          => $users,
            'event_comments' => $event_comments,
            
            'main_manager' => $main_manager,
            'sub_manager'  => $sub_manager,
            
            'go'             => $go,
            'undecided'      => $undecided,
            'ungo'           => $ungo
        ]);
    }
    // EVENT登録----------------
    public function event_store(Request $request) {
        // バリデーション
        $this->validate($request,[
            'title'  => 'required'
        ]);
        
        // 画像格納
        $file = $request->file('event_img');
        if (!empty($file)) {
            $filename = $file->getClientOriginalName();
            $move = $file->move('./upload/',$filename);
        } else {
            $filename = "";
        }

        // Eloquent モデル
        $events = new Event;
        $events->user_id     = Auth::user()->id;
        $events->club_id     = $request->club_id;
        $events->title       = $request->title;
        $events->subject     = $request->subject;
        $events->date        = $request->date;
        $events->place       = $request->place;
        $events->body        = $request->body;
        $events->event_img   = $filename;
        $events->save();    
        return redirect('/fencing_event');
    }
    // 編集画面-----------------------------------------
    public function event_edit(Event $all_events) {
        $all = Event::where('id',$all_events);
        return view('club/fencing/fencingeventedit', ['all_event' => $all_events]);
    }
    // 編集処理-------------------------
    public function event_update(Request $request) {
        // バリデーション
        $this->validate($request,[
            'title' => 'required',
        ]);
        // 画像格納
        $file = $request->file('event_img');
        if (!empty($file)) {
            $filename = $file->getClientOriginalName();
            $move = $file->move('./upload/',$filename);
        } else {
           $filename = "";
        }
        // Eloquent モデル
        $events = Event::where('id',$request->id)->first();
        $events->title     = $request->title;
        $events->subject   = $request->subject;
        $events->date      = $request->date;
        $events->place     = $request->place;
        $events->body      = $request->body;
        $events->event_img = $filename;
        $events->save();
        return redirect('/fencing_event');
    }
    // 削除処理-------------------------------------------
    public function event_destroy(Event $all_event) {
        $all_event->delete();
        return redirect('/fencing_event');
    }
    
    // 参加可否登録---------------------------------------------
    public function participate_store(Request $request) {
        
        // Eloquent モデル
        $participates = new Participate;
        $participates->user_id   = Auth::user()->id;
        $participates->event_id  = $request->event_id;
        $participates->go        = $request->go;
        $participates->undecided = $request->undecided;
        $participates->ungo      = $request->ungo;
        $participates->save();    
        return redirect('/fencing_event');
    }
    // 参加者ページ表示 ---------------------------------
    public function participants() {
        $alls       = ClubId::where('club_id',2)->latest()->get();
        $auths      = Auth::user();
        $users      = DB::table('club_ids')->where('club_id',2)->distinct()->count('user_id');
        $all_events = Event::where('club_id',2)->latest()->get();
        $events     = Event::where('user_id',Auth::user()->id)->get();
        
        $main_manager = Admin::where('admin', 1)->where('club_id',2)->latest()->first();
        $sub_manager  = Admin::where('admin', 2)->where('club_id',2)->latest()->first();
       
        //本来はフェンシング部(各々の部活)に登録している人数文をlengthに設定しなければいけない-----
        for ($i=0; $i<100; $i++) {
            $array_go_sum[$i] = DB::table('participates')->where('event_id',$i+1)->sum('go');
            $go_sum[ $i+1 ]   = $array_go_sum[ $i ];
            
            $array_undecided_sum[$i] = DB::table('participates')->where('event_id',$i+1)->sum('undecided');
            $undecided_sum[ $i+1 ]   = $array_undecided_sum[ $i ];
            
            $array_ungo_sum[$i] = DB::table('participates')->where('event_id',$i+1)->sum('ungo');
            $ungo_sum[ $i+1 ]   = $array_ungo_sum[ $i ];
        }
       
        return view('club/fencing/fencingparticipants', [
            'auths'         => $auths,
            'alls'          => $alls,
            'users'         => $users,
            'go_sum'        => $go_sum,
            'undecided_sum' => $undecided_sum,
            'ungo_sum'      => $ungo_sum,
            'all_events'    => $all_events, 
            'events'        => $events,
            
            'main_manager' => $main_manager,
            'sub_manager'  => $sub_manager
        ]);
    }
    
    // コメント登録
    public function event_create(Request $request) { 
        // バリデーション
        $this->validate($request,[
            'event_comment'  => 'required'
        ]);
        
        $discuss = new EventComment;
        $discuss->user_id       = Auth::user()->id;
        $discuss->post_id       = $request->post_id;
        $discuss->club_id       = $request->club_id;
        $discuss->event_comment = $request->event_comment;
        $discuss->save();    
        return redirect('/fencing_event');
    }
}
