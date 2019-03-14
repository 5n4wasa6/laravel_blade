<?php

namespace App\Http\Controllers\Club;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;

class JudoController extends Controller
{
    public function judo() {
        $auths        = Auth::user();
       
        return view('club/judo/judo', [
            'auths' => $auths
        ]);
    }
}
