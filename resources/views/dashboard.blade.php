@extends('layouts/master')

@section('content')

@javascript(compact('pusherKey', 'pusherCluster', 'usingNodeServer'))

<dashboard id="dashboard" columns="5" rows="10">
    <time-weather position="a1:b3" date-format="dddd MM/DD" time-zone="America/Lima" weather-city="Lima"></time-weather>
    <help position="e1:e10"></help>
    <moody position="a4:b10" src="http://moody.dev.andromeda.tektonlabs.com/admin/"></moody>
    <time-zone position="c1:c5" date-format="ddd MM/DD" time-format="hh:mm a"></time-zone>
    <ontime position="d1:d10"></ontime>
    <calendar calendar-summary="TK Events" position="c6:c8"></calendar>
    <calendar calendar-summary="TK Birthdays" position="c9:c10"></calendar>
    <internet-connection position="e1:e6"></internet-connection>
</dashboard>

@endsection
