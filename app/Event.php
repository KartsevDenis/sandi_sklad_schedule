<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $guarded = [];

//[id] => 5
//[start] => 2018-04-13T07:15:00.000Z
//[end] => 2018-04-13T16:15:00.000Z
//[title] => SD

    public static function event_change($data) {

        return self::updateOrCreate(
            ['id' => $data['id']],
            [
                'id' => $data['id'],
                'user_id' => 1,
                'start' => $data['start'],
                'end' => $data['end'],
                'title' => $data['title'],
                'description' => '',
            ]
        );

    }

    public static function event_get_all() {

        return self::all();

    }

}
