$(document).ready(function() {

    var year = new Date().getFullYear();
    var month = new Date().getMonth();
    var day = new Date().getDate();

    $('#calendar').weekCalendar({
        events:[
            {'id':1, 'start': new Date(year, month, day, 15), 'end': new Date(year, month, day, 13, 15),'title':'Daylux'},
            {'id':2, 'start': new Date(year, month, day, 9), 'end': new Date(year, month, day, 14, 40),'title':'Daylux'},
            {'id':3, 'start': new Date(year, month, day + 2, 18), 'end': new Date(year, month, day + 1, 18, 40),'title':'Eco'},
            {'id':4, 'start': new Date(year, month, day - 2, 8), 'end': new Date(year, month, day - 1, 9, 20),'title':'Airfel'},
            {'id':5, 'start': new Date(year, month, day, 14), 'end': new Date(year, month, day + 1, 15),'title':'SD'}
        ]
    });

});