<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class ChatsController extends Controller
{
    // 新着順にメッセージ一覧を取得
    public function delete() {
        $chats = Clubchat::where('id', $request->id)->delete();
    }
    // メッセージを登録
    public function create(Request $request) { 
        
        \App\Clubchat::create([
            'user_id'  => $request->users_id,
            'post_id'  => $request->posts_id,
            'club_id'  => $request->clubs_id,
            'body'     => $request->body2
        ]);
        
    }
}
