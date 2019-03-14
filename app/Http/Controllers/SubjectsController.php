<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\ClubId;
use App\Subject;

class SubjectsController extends Controller
{
    // 登録---------------------------------------------
    public function belongs(Request $request) {
        
        // Eloquent モデル
        $clubs = new ClubId;
        $clubs->user_id     = Auth::user()->id;
        $clubs->club_id     = $request->club_id;
        $clubs->save();   //「/」ルートにリダイレクト 
        return redirect('/club');
        
    }
}
