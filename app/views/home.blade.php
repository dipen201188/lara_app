@extends('layout.main')

@section('content')

@if(Auth::check())
    Hello, {{Auth::user()->username}}
    <p>{{Session::get('global');}}
@else
    <p>you are now logged out</p>

@endif
@stop
