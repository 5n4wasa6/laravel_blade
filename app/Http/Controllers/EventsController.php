<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Event;

class EventsController extends Controller
{
    // 最初に表示されるページ
    public function index() {
        $auths      = Auth::user();
        $all_events = Event::latest()->get();
        
        return view('event/events', [
            'auths'      => $auths,
            'all_events' => $all_events
        ]);
    }
}
