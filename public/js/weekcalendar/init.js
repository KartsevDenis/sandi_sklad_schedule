
window.temp_event = {};

var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

function event_ajax(calEvent) {

    var event = JSON.stringify(calEvent);

    $.ajax({
        url: '/event-change',
        type: "POST",
        data: {
            _token: CSRF_TOKEN,
            event: event,
        },
        dataType: "html",
        success: function () {

            console.log('event_ajax success')

        },
        error: function (xhr, ajaxOptions, thrownError) {

            console.log("Ошибка!", "Произошла ошибка event_ajax", "error");

        }
    });

}

function event_delete_ajax(id) {

    $.ajax({
        url: '/event-delete',
        type: "POST",
        data: {
            _token: CSRF_TOKEN,
            id: id,
        },
        dataType: "html",
        success: function () {

            console.log('event_delete_ajax success')

        },
        error: function (xhr, ajaxOptions, thrownError) {

            console.log("Ошибка!", "Произошла ошибка event_ajax", "error");

        }
    });

}

function load_all_events_ajax(callback) {

    $.ajax({
        url: '/events-ajax',
        type: "POST",
        data: { _token: CSRF_TOKEN},
        success: function (data) {

            var eventData = {
                options: {

                    allowEventDelete: true,
                    // eventDelete: function(calEvent, element, dayFreeBusyManager, calendar, clickEvent) {
                    //
                    //     if (confirm('Удалить событие?')) {
                    //
                    //         calendar.weekCalendar('removeEvent',calEvent.id);
                    //
                    //     }
                    //
                    // },
                    deletable: function(calEvent, element) {

                        return calEvent.deletable;

                    },

                    resizable: function(calEvent, element) {

                        return calEvent.resizable;

                    },
                    draggable: function(calEvent, element) {
                        return calEvent.draggable;
                    },

                },
                events: data,
            };

            callback(eventData);

        },
        error: function (xhr, ajaxOptions, thrownError) {

            console.log("Ошибка!", "Произошла ошибка event_get_all", "error");

        }
    });

}


$(document).ready(function() {

    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

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

            event_render(calEvent, $event);

        },
        eventDrag: function(calEvent, $event) {},
        eventResize: function(calEvent, $event) {

            event_resize(calEvent, $event);

        },
        eventDrop: function(calEvent, $event) {

            event_drop(calEvent, $event);

        },
        eventMouseover: function(calEvent, $event) {

            event_mouseover(calEvent, $event);

        },
        eventNew : function(calEvent, $event) {

            event_new(calEvent, $event);

        },
        eventDelete : function(calEvent, $event) {

            event_delete(calEvent, $event);

        },
        eventClick : function(calEvent, $event) {

            event_click(calEvent, $event);

        },
        data: function(start, end, callback) {

            load_all_events_ajax(callback);

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

    function event_delete(calEvent, $event) {

        if (confirm('Удалить событие?')) {

            event_delete_ajax(calEvent.id);

            $calendar.weekCalendar('removeEvent',calEvent.id);

        }

    }

    function event_drop(calEvent, $event) {

        var status = get_event_time_status(calEvent);

        if ( status == -1 ) {

            calEvent.start = window.temp_event.calEvent.start;
            calEvent.end = window.temp_event.calEvent.end;

        } else {

            event_ajax(calEvent);

        }

    }

    function event_click(calEvent, $event) {}

    function event_resize(calEvent, $event) {

        var status = get_event_time_status(calEvent);

        if ( status == -1 ) {

            calEvent.start = window.temp_event.calEvent.start;
            calEvent.end = window.temp_event.calEvent.end;

        } else {

            event_ajax(calEvent);

        }

    }

    function event_render(calEvent, $event) {

        var status = get_event_time_status(calEvent);

        if (calEvent.locked) {

            $event.addClass('locked');

        }

        if(status < 0) {

            $event.addClass('past-event');

        }

        if(status == 0) {

            $event.addClass('active-event');

        }

        if(status > 0) {

            $event.addClass('last-event');

        }

    }

    function event_mouseover(calEvent, $event) {

        var status = get_event_time_status(calEvent);

        console.log('eventMouseover, status - ' + status);

        window.temp_event.calEvent = calEvent;

        window.temp_event.event = $event;

        console.log(window.temp_event.calEvent);

    }

    function event_new(calEvent, $event) {

        var date = new Date;

        calEvent.id = date.getMilliseconds();

        var status = get_event_time_status(calEvent);

        if ( status > 0 ) {

            if (confirm('Добавить событие?')) {

                var description = prompt("Введите описание события", "")

                if (description != null) {

                    calEvent.description = description;

                    if( event_ajax(calEvent) ) {

                        $calendar.weekCalendar('refresh');

                    }

                }

            } else {

                console.log(calEvent.start + ' ' + calEvent.end + ' не добавлено');

                $calendar.weekCalendar('removeEvent',calEvent.id);

            }

        } else {

            alert('Вы не можете создавать события на прошедшее время!');

            $calendar.weekCalendar('removeEvent',calEvent.id);

        }

    }

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



// var year = new Date().getFullYear();
// var month = new Date().getMonth();
// var day = new Date().getDate();
//
// var eventData1 = {
//     options: {
//         timeslotsPerHour: 4,
//         timeslotHeight: 20
//     },
//     events : [
//         {'id':1, 'start': new Date(year, month, day, 12), 'end': new Date(year, month, day, 13, 30),'title':'Potato'},
//         {'id':2, 'start': new Date(year, month, day, 14), 'end': new Date(year, month, day, 14, 45),'title':'Oras'},
//         {'id':3, 'start': new Date(year, month, day + 1, 18), 'end': new Date(year, month, day + 1, 18, 45),'title':'Grohe'},
//         {'id':4, 'start': new Date(year, month, day - 1, 8), 'end': new Date(year, month, day - 1, 9, 30),'title':'Cosh'},
//         {'id':5, 'start': new Date(year, month, day + 1, 14), 'end': new Date(year, month, day + 1, 15),'title':'Q-Tap'}
//     ]
// };
//
// var eventData2 = {
//     options: {
//         timeslotsPerHour: 3,
//         timeslotHeight: 30
//     },
//     events : [
//         {'id':1, 'start': new Date(year, month, day, 12), 'end': new Date(year, month, day, 10, 10),'title':'ICMA'},
//         {'id':2, 'start': new Date(year, month, day, 14), 'end': new Date(year, month, day, 14, 40),'title':'SD'},
//     ]
// };
//
//
// // data set 3 : using event delete features
// var eventData3 = {
//     options: {
//         allowEventDelete: true,
//         eventDelete: function(calEvent, element, dayFreeBusyManager, calendar, clickEvent) {
//
//             if (confirm('Удалить событие?')) {
//
//                 calendar.weekCalendar('removeEvent',calEvent.id);
//
//             }
//
//         },
//
//         deletable: function(calEvent, element) {
//
//             return calEvent.start > Date.today();
//
//         }
//     },
//     events : [
//         {'id':1, 'start': new Date(year, month, day, 15), 'end': new Date(year, month, day, 13, 15),'title':'Daylux'},
//         {'id':2, 'start': new Date(year, month, day, 9), 'end': new Date(year, month, day, 14, 40),'title':'Daylux'},
//         {'id':3, 'start': new Date(year, month, day + 2, 18), 'end': new Date(year, month, day + 1, 18, 40),'title':'Eco'},
//         {'id':4, 'start': new Date(year, month, day - 2, 8), 'end': new Date(year, month, day - 1, 9, 20),'title':'Airfel'},
//         {'id':5, 'start': new Date(year, month, day, 14), 'end': new Date(year, month, day + 1, 15),'title':'SD'}
//     ]
// };
//
// // data set 3 : using event delete features
// var eventData3 = {
//
//     events : [
//         {'id':1, 'start': new Date(year, month, day, 15), 'end': new Date(year, month, day, 13, 15),'title':'Daylux'},
//         {'id':2, 'start': new Date(year, month, day, 9), 'end': new Date(year, month, day, 14, 40),'title':'Daylux'},
//         {'id':3, 'start': new Date(year, month, day + 2, 18), 'end': new Date(year, month, day + 1, 18, 40),'title':'Eco'},
//         {'id':4, 'start': new Date(year, month, day - 2, 8), 'end': new Date(year, month, day - 1, 9, 20),'title':'Airfel'},
//         {'id':5, 'start': new Date(year, month, day, 14), 'end': new Date(year, month, day + 1, 15),'title':'SD'}
//     ]
// };
//
// var eventData4 = {
//     options: {
//         allowEventDelete: true,
//         eventDelete: function(calEvent, element, dayFreeBusyManager, calendar, clickEvent) {
//
//             if (confirm('Удалить событие?')) {
//
//                 calendar.weekCalendar('removeEvent',calEvent.id);
//
//             }
//
//         },
//
//         deletable: function(calEvent, element) {
//
//             return calEvent.start > Date.today();
//
//         }
//     },
// };