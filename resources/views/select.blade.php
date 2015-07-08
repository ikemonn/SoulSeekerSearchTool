@extends('layout')

@section('title')
select
@stop

@section('content')

<h3>list</h3>
@foreach($heros as $hero)
	{{$hero->name}}<br>
@endforeach


@stop