@extends('layouts/master')

@section('content')

@javascript(compact('pusherKey', 'clientConnectionPath', 'environment', 'openWeatherMapKey'))

<div id="dashboard">
    <dashboard id="dashboard" class="font-sans">
        <time-weather position="a1:a5" date-format="dddd MM/DD" time-zone="America/Lima" weather-city="Lima"></time-weather>
        <time-zone position="b1:b5" date-format="ddd MM/DD" time-format="hh:mm a"></time-zone>
        <ontime position="c1:c10" calendar-title="Ontime Today"></ontime>
        <moody position="a6:b10" src="http://moody.tektonlabs.com/admin/"></moody>
        <calendar position="d1:d5" calendar-summary="TK Events" calendar-title="Events"></calendar>
        <calendar position="d6:d10" calendar-summary="TK Birthdays" calendar-title="Birthdays"></calendar>
        <internet-connection position="e10:e10"></internet-connection>
        <help position="e1:e10"></help>
    </dashboard>
</div>
@endsection
