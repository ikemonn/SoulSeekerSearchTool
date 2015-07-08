@extends('layout')

@section('title')
select
@stop

@section('content')

<h3>list</h3>

<div class="table-responsive">
	<table class="table table-bordered table-striped">
		<thead>
			<tr>
				<th>No.</th>
				<th>名前</th>
				<th>タイプ</th>
				<th>攻撃力</th>
				<th>防御力</th>
				<th>体力</th>
				<th>攻撃速度</th>
				<th>移動速度</th>
				<th>クリティカル率</th>
				<th>攻撃サポート率</th>
				<th>防御サポート率</th>
				<th>体力サポート率</th>
			</tr>

		</thead>
		<tbody>
			@foreach($heros as $hero)
				<tr>
					<td>{{$hero->id}}</td>
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
					<td>{{$hero->critical}}</td>
				</tr>
			@endforeach

		</tbody>
	</table>
</div>


@stop