$(document).ready(function () {

	// PHPから何を元にソートするかを取得
	var script = $('#script');
	var sort = JSON.parse(script.attr('data-string'));
	changeColor(sort);

	// チェックボックスをクリックされた時に、タイプの表示非表示を切り替え
	$('input[name=type]').click(refineType);

	// 全選択
	$('#select_all').change(function(){
		if ($(this).is(':checked')) {
			selectAll(true);
			$('#disselect_all').prop('checked', false);
		}
	});

	// 全選択解除
	$('#disselect_all').change(function(){
		if ($(this).is(':checked')) {
			selectAll(false);
			$('#select_all').prop('checked', false);
		}
	});

	// レア度のラジオボタンをクリックされた時に、タイプの表示非表示を切り替え
	$('input[name=rarity]').click(refineRarity);

});


// ソートの種類によってカラムの色を返る
function changeColor(sortKind) {
	var column = null;
	switch (sortKind) {
		case "No":
			column = $(".no");
			break;
		case "Support":
			column = $(".support");
			break;
		case "Leader":
			column = $(".leader");
			break;
		default :
			break;
	}
	if (column != null) {
		column.addClass("success");
	};
}


// タイプでの絞込み
function refineType() {
	// 全てのタイプを取得し、選択されたものだけ表示する
	var all_type_list = $('#type-form [name=type]').map(function(){return $(this).val();});

	var selected_type_list = $('#type-form [name=type]:checked').map(function(){return $(this).val();});
	var unselected_type_list = $(all_type_list).not(selected_type_list).get();

	// 表示
	$.each(selected_type_list, function(index, elem) {
		$('.' + elem).show();
	})
	// 非表示
	$.each(unselected_type_list, function(index, elem) {
		$('.' + elem).hide();
	})
}

// 全選択するか
function selectAll(isSelectAll) {
	$('#type-form [name=type]').map(function(){return $(this).prop('checked', isSelectAll);})
	refineType();
}

// レア度での絞込み
function refineRarity() {
	// 全てのタイプを取得し、選択されたものだけ表示する
	var all_type_list = $('#rarity-form [name=rarity]:checked').map(function(){return $(this).val();});

	// console.log(all_type_list);
	// var num = 6;
	// $.ajax({
	// 	type: "GET",
	// 	url: "rarity/" + num,
	// 	data: "",
	// 	success: function(msg){
	// 	alert( "Data Saved: " + msg );
	// }
	// });
	// var selected_type_list = $('#type-form [name=type]:checked').map(function(){return $(this).val();});
	// var unselected_type_list = $(all_type_list).not(selected_type_list).get();
	//
	// // 表示
	// $.each(selected_type_list, function(index, elem) {
	// 	$('.' + elem).show();
	// })
	// // 非表示
	// $.each(unselected_type_list, function(index, elem) {
	// 	$('.' + elem).hide();
	// })
}
