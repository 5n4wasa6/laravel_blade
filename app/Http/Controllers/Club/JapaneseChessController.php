<?php

namespace App\Http\Controllers\Club;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;

class JapaneseChessController extends Controller
{
    // 将棋 TOPページ (Discussページ)-----------------------------------------------------------------------
    public function japanesechess() {
        $auths        = Auth::user();
       
        return view('club/japanesechess/japanesechess', [
            'auths' => $auths
        ]);
    }
}
