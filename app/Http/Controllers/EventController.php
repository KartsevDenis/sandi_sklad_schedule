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

        $result = [

            'own' => [],

            'other' => [],

            'editor' => [],

        ];

        $events = Event::event_get_all();

        foreach ($events as $key => $event) {

            if (1 == $event['user_id']) {

                $result['own'][] = $event;

            } else {

                $result['other'][] = $event;

            }

        }

        return response()->json($result);

    }

    public function event_change(Request $request) {

        $post = $request->input();

        $event = collect(json_decode( $post['event'] ));

        Event::event_change($event);

    }

}
