<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Event;

class EventController extends Controller
{

    public function events() {

        return view('weekcalendar');

    }

    public function events_ajax() {

        $events = Event::event_get_all();

        foreach ($events as $key => $event) {

            if ( auth()->check() && auth()->user()->id == $event['user_id'] ) {

                $events[$key]['locked'] = false;
                $events[$key]['deletable'] = true;
                $events[$key]['draggable'] = true;
                $events[$key]['resizable'] = true;

            } else {

                $events[$key]['locked'] = true;
                $events[$key]['deletable'] = false;
                $events[$key]['draggable'] = false;
                $events[$key]['resizable'] = false;

            }

            $events[$key]['title'] = '<p>' . auth()->user()->department . '</p><p>' . $event['description'] . '</p><p>' . auth()->user()->name . '</p><p>' . auth()->user()->email . '</p>';

        }

        return response()->json($events);

    }

    public function event_delete(Request $request) {

        $post = $request->input();

        $id = collect(json_decode( $post['id'] ));

        Event::event_delete($id);

    }

    public function event_change(Request $request) {

        $post = $request->input();

        $event = collect(json_decode( $post['event'] ));

        Event::event_change($event);

    }

}
