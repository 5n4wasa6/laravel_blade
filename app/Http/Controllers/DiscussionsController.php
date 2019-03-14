<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use Auth;
use App\ActivityComment;
use App\Discussion;
use App\DiscussionComment;
use App\Gauge;
use App\Profile;
use App\User;

class DiscussionsController extends Controller
{
    //コンストラクタ 最初に必ず実行する関数-----------------------------------------
    public function __construct()
    {
        $this->middleware('auth');
    }
    // 最初に表示されるページ-----------------------------------------
    public function index() {
        $auths             = Auth::user();
        $discussions       = Discussion::latest()->get();
        $discussion        = Discussion::latest()->first();
        // $discussion_sum    = DB::table('discussion_comments')->count('commentable_id');
    
        for ($i=0; $i<100; $i++) {
            $array_discussion_sum[$i] = DB::table('discussion_comments')->where('commentable_id',$i+1)->count();
            $discussion_sum[ $i+1 ]   = $array_discussion_sum[$i];
        }
        
    
        $today             = Carbon::today();
        $discussion_id    = Discussion::find($discussion->id);
        $tests            = DiscussionComment::latest()->get();
        
        
        $profile           = Profile::where('user_id',Auth::user()->id)->latest()->first();
        $profile_tls       = Profile::whereIn('id', function($query) { $query->select(DB::raw('MAX(id) As id'))->from('profiles')->groupBy('user_id'); })->get();
    
        $comments_activity = ActivityComment::latest()->paginate(4);
        for ($i=0; $i<100; $i++) {
            $array_comment_activity_sum[$i] = DB::table('activity_comments')->where('post_id',$i+1)->count();
            $comment_activity_sum[ $i+1 ]   = $array_comment_activity_sum[ $i ];
        }
        
        
        
        $alls       = Gauge::latest()->get();
        
        $user_coins = Gauge::where('user_id',Auth::user()->id)->latest()->first();
        $swims      = Gauge::whereIn('id', function($query) { $query->select(DB::raw('MAX(id) As id'))->from('gauges')->groupBy('language','user_id')->where('language','SWIM'); })->get();
        $bikes      = Gauge::whereIn('id', function($query) { $query->select(DB::raw('MAX(id) As id'))->from('gauges')->groupBy('language','user_id')->where('language','BIKE'); })->get();
        $runs       = Gauge::whereIn('id', function($query) { $query->select(DB::raw('MAX(id) As id'))->from('gauges')->groupBy('language','user_id')->where('language','RUN'); })->get();
        
        return view('index', [
            'auths'                => $auths,
            'comments_activity'    => $comments_activity,
            'comment_activity_sum' => $comment_activity_sum,
            'discussion_id'        => $discussion_id,
            'tests'                => $tests,
            'alls'                 => $alls,
            'discussions'          => $discussions,
            'discussion'           => $discussion,
            'discussion_sum'       => $discussion_sum,
            'profile'              => $profile,
            'profile_tls'          => $profile_tls,
            'today'                => $today,
            
            'user_coins'           => $user_coins,
            'swims'                => $swims,
            'bikes'                => $bikes,
            'runs'                 => $runs
        ]);
    }
    // コメント登録---------------------------------------------
    public function store(Request $request)
    {
        $comment = new DiscussionComment;
        $comment->body = $request->get('comment');
        $comment->user()->associate($request->user());
        $post = Discussion::find($request->get('post_id'));
        $post->comments()->save($comment);

        return back();
    }
    // コメント登録---------------------------------------------
    public function replyStore(Request $request)
    {
        $reply  = new DiscussionComment();
        $reply->body      = $request->comment_body;
        $reply->user()->associate($request->user());
        $reply->parent_id = $request->comment_id;
        $post             = Discussion::find($request->post_id);
        $post->comments()->save($reply);

        return back();
    }
    
    
    // コメント登録---------------------------------------------
    // public function discussion(Request $request) {
    //     // バリデーション
    //     $this->validate($request,[
    //         'comment'  => 'required| max:255',
    //     ]);
    
    //     // Eloquent モデル
    //     $comments = new DiscussionComment;
    //     $comments->user_id  = Auth::user()->id;
    //     $comments->post_id  = $request->post_id;
    //     $comments->comment  = $request->comment;
    //     $comments->save();    
    //     return redirect('/');
    // }
    // テーマ全件表示ページ-------------------------------------
    public function all_discussion() {
        $auths          = Auth::user();
        $comments       = DiscussionComment::latest()->paginate(5);
        $discussions    = Discussion::latest()->get();
        $discussion_sum = DB::table('discussion_comments')->where('commentable_id',1)->count();
        
        return view('alldiscussion', [
            'auths'          => $auths,
            'comments'       => $comments,
            'discussions'    => $discussions,
            'discussion_sum' => $discussion_sum,
        ]);
    }
    // コメント全件表示ページ
    public function all_comment() {
        $auths          = Auth::user();
        $comments       = DiscussionComment::latest()->get();
        $discussion     = Discussion::latest()->first();
        $discussions    = Discussion::latest()->get();
        $discussion_id  = Discussion::find($discussion->id);
        
        $discussion_sum = DB::table('discussion_comments')->where('parent_id',2)->count();
        $profile        = Profile::where('user_id',Auth::user()->id)->latest()->first();
        $profile_tls    = Profile::whereIn('id', function($query) { $query->select(DB::raw('MAX(id) As id'))->from('profiles')->groupBy('user_id'); })->get();
        $tests          = DiscussionComment::latest()->get();
        $today          = Carbon::today();
        
        return view('commentdiscussion', [
            'auths'          => $auths,
            'comments'       => $comments,
            'discussion'     => $discussion,
            'discussions'    => $discussions,
            'discussion_id'  => $discussion_id,
            'discussion_sum' => $discussion_sum,
            'profile'        => $profile,
            'profile_tls'    => $profile_tls,
            'tests'          => $tests,
            'today'          => $today
        ]);
    }
}
