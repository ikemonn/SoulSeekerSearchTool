@extends('layout')

@section('title')
SoulSeeker ☆6一覧
@stop

@section('content')

<h3>list</h3>

<div class="table-responsive">
	<table class="table table-bordered table-striped">
		<thead>
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
		<tbody>
			@foreach($heros as $hero)
				<tr>
					<td>{{$hero->support_nature_rank}}</td>
					<td>{{$hero->leader_nature_rank}}</td>
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