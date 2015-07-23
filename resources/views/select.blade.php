@extends('layout')

@section('title')
SoulSeeker Search Tool
@stop

@section('content')

<h3><a href="/">SoulSeeker ☆6一覧</a></h3>

<hr/>
<div class="form-inline form-group">
{!! Form::open(array('url' => URL::to('/', array(), true), 'method' => 'get')) !!}
    <div class="form-group">
        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => '名前']) !!}
		    {!! Form::submit('検索', ['class' => 'btn btn-primary']) !!}
    </div>
{!! Form::close() !!}
</div>

<div class="container">
    <div class="row">
        <div class="col-md-1 no-padding">
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

        </div>
        <div class="col-md-5">
            <form id="type-form">
                <div class="form-group search-check-box">
                    <div class="checkbox-inline">
                        <input type="checkbox" value="type-1" name="type" id="attack_type" checked>
                        <label for="attack_type">攻撃型</label>
                    </div>
                    <div class="checkbox-inline">
                        <input type="checkbox" value="type-2" name="type" id="deffence_type" checked>
                        <label for="deffence_type">防御型</label>
                    </div>
                    <div class="checkbox-inline">
                        <input type="checkbox" value="type-3" name="type" id="almighty_type" checked>
                        <label for="almighty_type">万能型</label>
                    </div>
                    <div class="checkbox-inline">
                        <input type="checkbox" value="type-4" name="type" id="support_type" checked>
                        <label for="support_type">サポート型</label>
                    </div>
                </div>
            </form>
        </div>
    </div>
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
				<tr class="type-{{$hero->type}}">
					<td class="support">{{$hero->support_nature_rank}}</td>
					<td class="leader">{{$hero->leader_nature_rank}}</td>
					<td class="no">{{$hero->id}}</td>
					<td>{{$hero->name}}</td>
					<td>{{$hero->type_name}}</td>
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
