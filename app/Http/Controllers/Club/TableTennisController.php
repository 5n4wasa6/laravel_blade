<?php

namespace App\Http\Controllers\Club;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;

class TableTennisController extends Controller
{
    public function tabletennis() {
        $auths        = Auth::user();
       
        return view('club/tabletennis/tabletennis', [
            'auths' => $auths
        ]);
    }
}
