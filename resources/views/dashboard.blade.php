@extends('layouts/master')

@section('content')

@javascript(compact('pusherKey', 'clientConnectionPath', 'environment', 'openWeatherMapKey'))

<div id="dashboard">
    <dashboard id="dashboard" class="font-sans">
        <time-weather position="a1:a5" date-format="dddd MM/DD" time-zone="America/Lima" weather-city="Lima" src="{{asset('images/logo.png')}}"></time-weather>
        <time-zone position="b1:b5" date-format="ddd MM/DD" time-format="hh:mm a"></time-zone>
        <calendar position="d1:d5" calendar-summary="TK Events" calendar-title="Events👯"></calendar>
        <calendar position="c1:c5" calendar-summary="TK Birthdays" calendar-title="Birthdays🎂"></calendar>
        <ontime position="e1:e10" calendar-title="👩‍💻 Ontime 👨‍💻"></ontime>
        <help position="d6:d10"></help>
        <team-members position="a6:c10"></team-members>
        <internet-connection position="e10:e6"></internet-connection>
    </dashboard>
</div>
@endsection
