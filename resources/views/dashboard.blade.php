@extends('layouts/master')

@section('content')
@javascript(compact('pusherKey', 'pusherCluster', 'usingNodeServer'))

<dashboard id="dashboard" columns="5" rows="12">
    <!-- <twitter :initial-tweets="{{ json_encode($initialTweets) }}" position="a1:a12"></twitter> -->
    <!--
    <uptime position="a1:a12"></uptime>
    <packagist position="b1:b4"></packagist>
    <npm position="b5:b8"></npm>
    <github position="b12:b12"></github>
    <music position="d10:d12"></music>
    <tasks team-member="joca" position="c7:c12"></tasks>
    <tasks team-member="miguelito" position="c10:c12"></tasks>
    <tasks team-member="willem" position="d7:d12"></tasks>
    -->
    <time-weather position="a1:b3" date-format="dddd MM/DD" time-zone="America/Lima" weather-city="Lima"></time-weather>
    <help position="d7:d12"></help>
    <moody position="a4:b12" src="http://moody.dev.andromeda.tektonlabs.com/admin/"></moody>
    <time-zone position="c1:c6" date-format="ddd MM/DD" time-format="hh:mm a"></time-zone>
    <ontime position="d1:d6"></ontime>
    <calendar calendar-summary="TK Events" position="c7:c9"></calendar>
    <calendar calendar-summary="TK Birthdays" position="c10:c12"></calendar>
    <internet-connection></internet-connection>
</dashboard>

@endsection
