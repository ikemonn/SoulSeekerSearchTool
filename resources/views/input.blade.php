@extends('layout')

@section('title')
input
@stop

@section('content')
<form action="res" method="post">
<input type="input" name="name">
<input type="submit" value="Search">
<input type="hidden" name="_token" value="{{csrf_token()}}">
</form>
@stop