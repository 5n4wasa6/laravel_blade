<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Auth;
use App\Profile;

class ProfilesController extends Controller
{
    // 最初に表示されるページ---------------------------------------------------
    public function index() {
        $auths = Auth::user();
        $profiles = Profile::where('user_id',Auth::user()->id)->latest()->paginate(5);
        
        return view('profiles', [
            'auths'    => $auths,
            'profiles' => $profiles
        ]);
    }
    // 登録---------------------------------------------------------------------
    public function store(Request $request) {
        // バリデーション
        $this->validate($request,[
            'comment_img'  => 'required'
        ]);
        
        $file = $request->file('comment_img');
        if (!empty($file)) {
            $filename = $file->getClientOriginalName();
            $move = $file->move('./upload/',$filename);
        } else {
            $filename = "";
        }
        
        // Eloquent モデル
        $profiles = new Profile;
        $profiles->user_id     = Auth::user()->id;
        $profiles->comment_img = $filename;
        $profiles->save();   //「/」ルートにリダイレクト 
        return redirect('/comment');
    }
    // 削除処理-----------------------------------------------------------------
    public function destroy(profile $profile) {
        $profile->delete();
        
        return redirect('/profile');
    }
}
