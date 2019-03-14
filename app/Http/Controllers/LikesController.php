<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Dislike;
use App\Introduction;
use App\Like;
use App\Oneword;

class LikesController extends Controller
{
    // 最初に表示されるページ
    public function index() {
        $auths = Auth::user();
        $comments = Introduction::where('user_id',Auth::user()->id)->get();
        $dislikes  = Dislike::where('user_id',Auth::user()->id)->latest()->get();
        $likes     = Like::where('user_id',Auth::user()->id)->latest()->get();

        return view('likedislikes', [
            'likes'    => $likes,
            'dislikes' => $dislikes,
            'comments' => $comments,
            'auths'    => $auths
        ]);
    }
    // 登録(Like)-----------------------------------------
    public function likestore(Request $request) {
        // バリデーション
        $this->validate($request,[
            'like'       => 'required| max:255',
        ]);
        // Eloquent モデル
        $likes = new Like;
        $likes->user_id  = Auth::user()->id;
        $likes->like     = $request->like;
        $likes->save();   //「/」ルートにリダイレクト 
        return redirect('/likedislike');
    }
    // 削除処理-------------------------------------------
    public function likedestroy(Like $like) {
        $like->delete();
        return redirect('/likedislike');
    }
    
    
    // 登録(Dislike)-----------------------------------------
    public function dislikestore(Request $request) {
        // バリデーション
        $this->validate($request,[
            'dislike'       => 'required| max:255',
        ]);
        // Eloquent モデル
        $dislikes = new Dislike;
        $dislikes->user_id  = Auth::user()->id;
        $dislikes->dislike     = $request->dislike;
        $dislikes->save();   //「/」ルートにリダイレクト 
        return redirect('/likedislike');
    }
    
    // 削除処理-------------------------------------------
    public function dislikedestroy(Dislike $dislike) {
        $dislike->delete();
        return redirect('/likedislike');
    }
    
    // One Word登録-----------------------------------------
    public function onewordstore(Request $request) {
        // バリデーション
        $this->validate($request,[
            'oneword' => 'required| max:15',
        ]);
        // Eloquent モデル
        $likes = new Oneword;
        $likes->user_id = Auth::user()->id;
        $likes->oneword = $request->oneword;
        $likes->save();   //「/」ルートにリダイレクト 
        return redirect('/comment');
    }
}
