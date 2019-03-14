<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

use Auth;
use App\Admin;
use App\Club;
use App\ClubId;
use App\EventComment;
use App\Rule;
use App\Event;
use App\Clubchat;
use App\Subject;
use App\Participate;


class ClubsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    // My Clubページ表示--------------------------------------------------------------------------------------------
    public function index() {
        $auths    = Auth::user();
        $club_ids = ClubId::where('user_id',Auth::user()->id)->latest()->get(); 
        $subjects = Subject::latest()->get(); 
       
        return view('club/clubs', [
            'auths'    => $auths,
            'club_ids' => $club_ids,
            'subjects' => $subjects
        ]);
    }
}
