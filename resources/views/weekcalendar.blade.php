<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />

    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>SANDI+ Schedule</title>

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
    <script type='text/javascript' src='js/weekcalendar/init.js'></script>

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
