<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class EventController extends Controller
{

    public function event()
    {

        $now = Carbon::now();

        $now->timezone = 'Europe/Kiev';

        //$now->month($now->month + 1);

        dd($now->hour->format('D M d Y h:i:s O'));

        //{'id':1, 'start': new Date(year, month, day, 12), 'end': new Date(year, month, day, 13, 30),'title':'Potato'},

        $this->data['events'] = [

            [ 'id' => '1', 'start' => $now->, 'end' => '', 'title' => '',],

        ];

        return view('weekcalendar', $this->data);

    }

}
