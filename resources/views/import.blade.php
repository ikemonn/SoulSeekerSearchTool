@extends('import_layout')

@section('title')
SoulSeeker Search Tool
@stop

@section('content')

<h3><a href="/">SoulSeeker ☆6・超越一覧へ</a></h3>
{!! Form::open(array('url' => '/import', 'files' => true, 'method' => 'post')) !!}
{!! Form::file('csv') !!}
{!! Form::submit('アップロード') !!}
{!! Form::close() !!}



<!-- {!! Form::open(array('url' => URL::to('/', array(), true), 'method' => 'get')) !!}
    <div class="form-group">
        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => '名前']) !!}
		    {!! Form::submit('検索', ['class' => 'btn btn-primary']) !!}
    </div>
{!! Form::close() !!} -->

@stop
