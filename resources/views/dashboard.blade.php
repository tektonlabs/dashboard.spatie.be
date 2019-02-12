@extends('layouts/master')

@section('content')

@javascript(compact('pusherKey', 'clientConnectionPath', 'environment', 'openWeatherMapKey'))

<div id="dashboard">
    <dashboard id="dashboard" class="font-sans">
        <time-weather position="a1:b3" date-format="dddd MM/DD" time-zone="America/Lima" weather-city="Lima"></time-weather>
        <help position="e1:e10"></help>
        <ontime position="d1:d10"></ontime>
        <moody position="a4:b10" src="http://moody.dev.andromeda.tektonlabs.com/admin/"></moody>
        <time-zone position="c1:c5" date-format="ddd MM/DD" time-format="hh:mm a"></time-zone>
        <calendar calendar-summary="TK Events" position="c6:c8"></calendar>
        <calendar calendar-summary="TK Birthdays" position="c9:c10"></calendar>
        <internet-connection position="a10:a10"></internet-connection>
    </dashboard>
</div>
@endsection
