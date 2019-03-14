<?php

namespace App\Http\Controllers\Club;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;

class TennisController extends Controller
{
    public function tennis() {
        $auths        = Auth::user();
       
        return view('club/tennis/tennis', [
            'auths' => $auths
        ]);
    }
}
