<?php

namespace App\Http\Controllers\Club;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;

class BudmintonController extends Controller
{
    // バドミントン TOPページ (Discussページ)-----------------------------------------------------------------------
    public function budminton() {
        $auths        = Auth::user();
       
        return view('club/budminton/budminton', [
            'auths' => $auths
        ]);
    }
}
