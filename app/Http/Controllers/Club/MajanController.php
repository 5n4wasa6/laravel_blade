<?php

namespace App\Http\Controllers\Club;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;

class MajanController extends Controller
{
    public function majan() {
        $auths        = Auth::user();
       
        return view('club/majan/majan', [
            'auths' => $auths
        ]);
    }
}
