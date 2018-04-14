<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Event;

class EventController extends Controller
{

    public function event()
    {

        $now = Carbon::now();

        $now->timezone = 'Europe/Kiev';

        //$now->month($now->month + 1);

        dd($now->hour->format('D M d Y h:i:s O'));

        //{'id':1, 'start': new Date(year, month, day, 12), 'end': new Date(year, month, day, 13, 30),'title':'Potato'},

        return view('weekcalendar', $this->data);

    }

    public function events() {

        $this->data['events'] = Event::event_get_all();

        //dd($this->data['events']);

        return view('weekcalendar', $this->data);

    }

    public function events_ajax() {

        $events = Event::event_get_all();

        return response()->json($events);

    }

    public function event_change(Request $request) {

        $post = $request->input();

        $event = collect(json_decode( $post['event'] ));

        Event::event_change($event);

    }

}
