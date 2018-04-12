<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <title>Demo 2 - jQuery Week Calendar</title>

    <link rel='stylesheet' type='text/css' href='css/weekcalendar/libs/css/smoothness/jquery-ui-1.8.11.custom.css' />
    <link rel='stylesheet' type='text/css' href='css/weekcalendar/jquery.weekcalendar.css' />
    <link rel="stylesheet" type="text/css" href="css/weekcalendar/skins/default.css" />
    <style type='text/css'>
        body {
            font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
            margin: 0;
        }

        h1 {
            margin:0 0 2em;
            padding: 0.5em;
            font-size: 1.3em;
        }

        p.description {
            font-size: 0.8em;
            padding: 1em;
            position: absolute;
            top: 3.2em;
            margin-right: 400px;
        }

        .clearer {
            clear: both;
        }

        #calendar_selection {
            font-size: 0.7em;
            position: absolute;
            top: 1em;
            right: 1em;
            padding: 1em;
            background: #ffc;
            border: 1px solid #dda;
            width: 270px;
        }

        #message {
            font-size: 0.7em;
            padding: 1em;
            margin-right: 1em;
            margin-bottom: 10px;
            background: #ddf;
            border: 1px solid #aad;
            width: 270px;
            float: right;
        }
    </style>

    <script type='text/javascript' src='js/weekcalendar/libs/jquery-1.4.4.min.js'></script>
    <script type='text/javascript' src='js/weekcalendar/libs/jquery-ui-1.8.11.custom.min.js'></script>

    <script type="text/javascript" src="js/weekcalendar/libs/date.js"></script>
    <script type='text/javascript' src='js/weekcalendar/jquery.weekcalendar.js'></script>
    <script type='text/javascript'>


        window.temp_event = {};

        var year = new Date().getFullYear();
        var month = new Date().getMonth();
        var day = new Date().getDate();

        var eventData1 = {
            options: {
                timeslotsPerHour: 4,
                timeslotHeight: 20
            },
            events : [
                {'id':1, 'start': new Date(year, month, day, 12), 'end': new Date(year, month, day, 13, 30),'title':'Potato'},
                {'id':2, 'start': new Date(year, month, day, 14), 'end': new Date(year, month, day, 14, 45),'title':'Oras'},
                {'id':3, 'start': new Date(year, month, day + 1, 18), 'end': new Date(year, month, day + 1, 18, 45),'title':'Grohe'},
                {'id':4, 'start': new Date(year, month, day - 1, 8), 'end': new Date(year, month, day - 1, 9, 30),'title':'Cosh'},
                {'id':5, 'start': new Date(year, month, day + 1, 14), 'end': new Date(year, month, day + 1, 15),'title':'Q-Tap'}
            ]
        };

        var eventData2 = {
            options: {
                timeslotsPerHour: 3,
                timeslotHeight: 30
            },
            events : [
                {'id':1, 'start': new Date(year, month, day, 12), 'end': new Date(year, month, day, 10, 10),'title':'ICMA'},
                {'id':2, 'start': new Date(year, month, day, 14), 'end': new Date(year, month, day, 14, 40),'title':'SD'},
            ]
        };


        // data set 3 : using event delete features
        var eventData3 = {
            options: {
                allowEventDelete: true,
                eventDelete: function(calEvent, element, dayFreeBusyManager, calendar, clickEvent) {

                    if (confirm('Удалить событие?')) {

                        calendar.weekCalendar('removeEvent',calEvent.id);

                    }

                },

                deletable: function(calEvent, element) {

                    return calEvent.start > Date.today();

                }
            },
            events : [
                {'id':1, 'start': new Date(year, month, day, 15), 'end': new Date(year, month, day, 13, 15),'title':'Daylux'},
                {'id':2, 'start': new Date(year, month, day, 9), 'end': new Date(year, month, day, 14, 40),'title':'Daylux'},
                {'id':3, 'start': new Date(year, month, day + 2, 18), 'end': new Date(year, month, day + 1, 18, 40),'title':'Eco'},
                {'id':4, 'start': new Date(year, month, day - 2, 8), 'end': new Date(year, month, day - 1, 9, 20),'title':'Airfel'},
                {'id':5, 'start': new Date(year, month, day, 14), 'end': new Date(year, month, day + 1, 15),'title':'SD'}
            ]
        };

        // data set 3 : using event delete features
        var eventData3 = {
            options: {
                allowEventDelete: true,
                eventDelete: function(calEvent, element, dayFreeBusyManager, calendar, clickEvent) {

                    if (confirm('Удалить событие?')) {

                        calendar.weekCalendar('removeEvent',calEvent.id);

                    }

                },

                deletable: function(calEvent, element) {

                    return calEvent.start > Date.today();

                }
            },
            events : [
                {'id':1, 'start': new Date(year, month, day, 15), 'end': new Date(year, month, day, 13, 15),'title':'Daylux'},
                {'id':2, 'start': new Date(year, month, day, 9), 'end': new Date(year, month, day, 14, 40),'title':'Daylux'},
                {'id':3, 'start': new Date(year, month, day + 2, 18), 'end': new Date(year, month, day + 1, 18, 40),'title':'Eco'},
                {'id':4, 'start': new Date(year, month, day - 2, 8), 'end': new Date(year, month, day - 1, 9, 20),'title':'Airfel'},
                {'id':5, 'start': new Date(year, month, day, 14), 'end': new Date(year, month, day + 1, 15),'title':'SD'}
            ]
        };

        var eventData4 = {
            events : [
                {'id':1, 'start': new Date(year, month, day, 7, 0), 'end': new Date(year, month, day, 9, 15),'title':'Тест 1'},
                {'id':2, 'start': new Date(year, month, day, 10, 0), 'end': new Date(year, month, day, 13, 45),'title':'Тест 2'},
            ]
        };

        $(document).ready(function() {

              $('body').bind('mousemove', '.wc-scrollable-grid', function() {

                var y = 65 + $(window).scrollTop();

                $('.wc-mouse-hourline').css('top', event.pageY - y  + 'px');

              });

            var $calendar = $('#calendar').weekCalendar({
                firstDayOfWeek: 1,
                timeslotsPerHour: 4,
                scrollToHourMillis : 0,
                height: function($calendar){
                    //return $(window).height() - $('h1').outerHeight(true);
                    return $(window).height();
                },
                eventRender : function(calEvent, $event) {

                    var status = get_event_time_status(calEvent);

                    if(status < 0) {

                        $event.addClass('past-event');

                    }

                    if(status == 0) {

                        $event.addClass('active-event');

                    }

                    if(status > 0) {

                        $event.addClass('last-event');

                    }

                },
                eventDrag: function(calEvent, $event) {



                },
                eventDrop: function(calEvent, $event) {

                    var status = get_event_time_status(calEvent);

                    if ( status == -1 ) {

                        calEvent.start = window.temp_event.calEvent.start;
                        calEvent.end = window.temp_event.calEvent.end;

                        console.log(calEvent);

                    }

                    console.log('eventDrop, status ' + status);

                },
                eventMouseover: function(calEvent, $event) {

                    var status = get_event_time_status(calEvent);

                    console.log('eventMouseover, status - ' + status);

                    window.temp_event.calEvent = calEvent;

                    window.temp_event.event = $event;

                    console.log(window.temp_event.calEvent);

                },
                eventNew : function(calEvent, $event) {

                    var date = new Date;

                    calEvent.id = date.getMilliseconds();

                    var status = get_event_time_status(calEvent);

                    if ( status > 0 ) {

                        if (confirm('Добавить событие?')) {

                            console.log(calEvent.start + ' ' + calEvent.end + ' добавлено');

                        } else {

                            console.log(calEvent.start + ' ' + calEvent.end + ' не добавлено');

                            $calendar.weekCalendar('removeEvent',calEvent.id);

                        }

                    } else {

                        alert('Вы не можете создавать события на прошедшее время!');

                        $calendar.weekCalendar('removeEvent',calEvent.id);

                    }

                },
                eventClick : function(calEvent, $event) {
                    console.log(calEvent.title);
                },
                data: function(start, end, callback) {

                    var dataSource = $('#data_source').val();

                    if (dataSource === '1') {

                        callback(eventData1);

                    } else if(dataSource === '2') {

                        callback(eventData2);

                    } else if(dataSource === '3') {

                        callback(eventData3);

                    } else if(dataSource === '4') {

                        callback(eventData4);

                    } else {

                        callback([]);

                    }
                }
            });

            $('#data_source').change(function() {
                $calendar.weekCalendar('refresh');
                updateMessage();
            });

            function updateMessage() {
                var dataSource = $('#data_source').val();
                $('#message').fadeOut(function(){
                    if(dataSource === '1') {
                        //$('#message').text('Displaying event data set 1 with timeslots per hour of 4 and timeslot height of 20px');
                    } else if(dataSource === '2') {
                        //$('#message').text('Displaying event data set 2 with timeslots per hour of 3 and timeslot height of 30px');
                    } else if(dataSource === '3') {
                        //$('#message').text('Displaying event data set 3 with allowEventDelete enabled. Events before today will not be deletable. A confirmation dialog is opened when you delete an event.');
                    } else if(dataSource === '4') {
                        //$('#message').text('Displaying event data set 3 with allowEventDelete enabled. Events before today will not be deletable. A confirmation dialog is opened when you delete an event.');
                    } else {
                        //$('#message').text('Displaying no events.');
                    }
                    $(this).fadeIn();
                });
            }

            updateMessage();

            function get_event_time_status(calEvent) {

                var now = new Date().getTime(),
                        end = calEvent.end.getTime(),
                        start = calEvent.end.getTime();

                if(end < now) {

                    return -1;

                }

                if( (start < now) && (end > now) ) {

                    return 0;

                }

                if(start > now) {

                    return 1;

                }

            }

        });
    </script>
</head>
<body>

{{--<h1>Расписание/планировщик загруженности базы на неделю</h1>--}}

{{--<p class="description">Вы можете бронировать свободные участки времени.</p>--}}

{{--<div id="message" class="ui-corner-all"></div>--}}

{{--<div class="clearer"></div>--}}

<div id="calendar"></div>

<div id="calendar_selection" class="ui-corner-all">
    <select id="data_source">
        <option value="">Выбрать направление</option>
        <option value="1">Сантехника</option>
        <option value="2">Запорка</option>
        <option value="3">Радиаторы</option>
        <option value="4">Laravel</option>
    </select>
</div>

</body>
</html>
