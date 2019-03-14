<?php

namespace App\Http\Controllers\Club;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;

class RugbyController extends Controller
{
    public function rugby() {
        $auths        = Auth::user();
       
        return view('club/rugby/rugby', [
            'auths' => $auths
        ]);
    }
}
