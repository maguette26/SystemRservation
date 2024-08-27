<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventType;
use Illuminate\Http\Request;

class EventTypeController extends Controller
{
    public function exposition( )
    {

        $events = Event::where('event_type_id', 1)->get();

        return view('categorie.exposition', compact('events'));
}

        public function concert( )
    {
        $events = Event::where('event_type_id', 2)->get();

        return view('categorie.concert', compact('events'));
    }

        public function conference( )
    {

        $events = Event::where('event_type_id', 3)->get();
        
        return view('categorie.conference', compact('events'));

    }


}

