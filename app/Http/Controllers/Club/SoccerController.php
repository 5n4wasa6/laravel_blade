<?php

namespace App\Http\Controllers\Club;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;

class SoccerController extends Controller
{
    public function soccer() {
        $auths        = Auth::user();
       
        return view('club/soccer/soccer', [
            'auths' => $auths
        ]);
    }
}
