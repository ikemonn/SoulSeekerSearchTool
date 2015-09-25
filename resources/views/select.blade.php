@extends('layout')

@section('title')
SoulSeeker Search Tool
@stop

@section('content')

<h3><a href="/">SoulSeeker ☆6・超越一覧</a></h3>

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
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo (empty($_SERVER["HTTPS"]) ? "http://" : "https://") . $_SERVER["HTTP_HOST"]?>/leader_ranking/rarity/<?php
                    $rarity = 6;
                    if (preg_match("/rarity/", $_SERVER["REQUEST_URI"])) {
                        preg_match("/[0-9]+/",$_SERVER["REQUEST_URI"], $match);
                        $rarity = $match[0];
                        if($rarity !== '6' && $rarity !== '7') {
                            $rarity = 6;
                        }
                    }
                    echo $rarity;
                    ?>">リダランク</a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo (empty($_SERVER["HTTPS"]) ? "http://" : "https://") . $_SERVER["HTTP_HOST"]?>/support_ranking/rarity/<?php
                    $rarity = 6;
                    if (preg_match("/rarity/", $_SERVER["REQUEST_URI"])) {
                        preg_match("/[0-9]+/",$_SERVER["REQUEST_URI"], $match);
                        $rarity = $match[0];
                        if($rarity !== '6' && $rarity !== '7') {
                            $rarity = 6;
                        }
                    }
                    echo $rarity;
                    ?>">サポランク</a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo (empty($_SERVER["HTTPS"]) ? "http://" : "https://") . $_SERVER["HTTP_HOST"]?>/rarity/<?php preg_match("/[0-9]+/",$_SERVER["REQUEST_URI"],$match); echo $match[0]; ?>">No.順</a></li>
                </ul>
                <!-- リストここまで -->
            </div>

        </div>
        <div class="col-md-8">

        <form id="rarity-form">
            <div class="form-group">
                <div class="radio-inline">
                    <input type="radio" value="<?php echo (empty($_SERVER["HTTPS"]) ? "http://" : "https://") . $_SERVER["HTTP_HOST"]?>/rarity/6" name="rarity" id="rarity6" onclick="location.href=this.value">
                    <label for="rarity6">☆6</label>
                </div>
                <div class="radio-inline">
                    <input type="radio" value="<?php echo (empty($_SERVER["HTTPS"]) ? "http://" : "https://") . $_SERVER["HTTP_HOST"]?>/rarity/7" name="rarity" id="rarity7" onclick="location.href=this.value">
                    <label for="rarity7">超越</label>
                </div>
            </div>
        </form>

            <!-- タイプと選択・全選択ボタン -->
            <form id="type-form">
                <div class="form-group search-check-box">
                    <div class="checkbox-inline">
                        <input type="checkbox" value="type-1" name="type" class="type_checkbox" id="attack_type" checked>
                        <label for="attack_type">攻撃型</label>
                    </div>
                    <div class="checkbox-inline">
                        <input type="checkbox" value="type-2" name="type" class="type_checkbox" id="deffence_type" checked>
                        <label for="deffence_type">防御型</label>
                    </div>
                    <div class="checkbox-inline">
                        <input type="checkbox" value="type-3" name="type" class="type_checkbox" id="almighty_type" checked>
                        <label for="almighty_type">万能型</label>
                    </div>
                    <div class="checkbox-inline">
                        <input type="checkbox" value="type-4" name="type" class="type_checkbox" id="support_type" checked>
                        <label for="support_type">サポート型</label>
                    </div>
                    <div class="checkbox-inline">
                        <input type="checkbox" value="select-all" name="select_type" id="select_all">
                        <label for="select_all">全選択</label>
                    </div>
                    <div class="checkbox-inline">
                        <input type="checkbox" value="disselect-all" name="select_type" id="disselect_all">
                        <label for="disselect_all">全選択解除</label>
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
					<td class="support">{{$hero->support_rank}}</td>
					<td class="leader">{{$hero->leader_rank}}</td>
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
