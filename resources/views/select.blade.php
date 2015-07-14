@extends('layout')

@section('title')
SoulSeeker Search Tool
@stop

@section('content')

<h3><a href="/">SoulSeeker ☆6一覧</a></h3>

<hr/>

{!! Form::open(array('url' => URL::to('/', array(), true), 'method' => 'get')) !!}
    <div class="form-group">
        {!! Form::label('name', '名前:') !!}
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>    
    <div class="form-group">
		{!! Form::submit('検索', ['class' => 'btn btn-primary form-control']) !!}
    </div>
{!! Form::close() !!}







<div class="dropdown">

  <!-- ここが表示されるボタン <a>タグでもOK -->
  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown">
    ソート
    <span class="caret"></span>
  </button>
  <!-- ボタンここまで -->
  
  <!-- ここはボタンを押すと表示されるリスト -->
  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
    <li role="presentation"><a role="menuitem" tabindex="-1" href="leader_ranking">リダランク</a></li>
    <li role="presentation"><a role="menuitem" tabindex="-1" href="support_ranking">サポランク</a></li>
	<li role="presentation"><a role="menuitem" tabindex="-1" href="./">No.順</a></li>
  </ul>
  <!-- リストここまで -->
</div>


<div class="table-responsive">
	<table class="table table-bordered table-striped">
		<thead class="scrollHead">
			<tr>
				<th>サポランク</th>
				<th>リダランク</th>
				<th>No.</th>
				<th>名前</th>
				<th>タイプ</th>
				<th>攻撃力</th>
				<th>防御力</th>
				<th>体力</th>
				<th>攻撃速度</th>
				<th>移動速度</th>
				<th>クリティカル率</th>
				<th>攻撃サポ率</th>
				<th>防御サポ率</th>
				<th>体力サポ率</th>
			</tr>

		</thead>
		<tbody class="scrollBody">
			@foreach($heros as $hero)
				<tr>
					<td class="support">{{$hero->support_nature_rank}}</td>
					<td class="leader">{{$hero->leader_nature_rank}}</td>
					<td class="no">{{$hero->id}}</td>
					<td>{{$hero->name}}</td>
					<td>{{$hero->type}}</td>
					<td>{{$hero->attack}}</td>
					<td>{{$hero->defence}}</td>
					<td>{{$hero->hp}}</td>
					<td>{{$hero->attack_speed}}</td>
					<td>{{$hero->move_speed}}</td>
					<td>{{$hero->critical}}</td>
					<td>{{$hero->attack_support}}</td>
					<td>{{$hero->defence_support}}</td>
					<td>{{$hero->hp_support}}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>
@stop