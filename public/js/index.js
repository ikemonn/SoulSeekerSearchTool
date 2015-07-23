$(document).ready(function () {

	// PHPから何を元にソートするかを取得
	var script = $('#script');
	var sort = JSON.parse(script.attr('data-string'));
	changeColor(sort);

	$(":checkbox").click(refineType);

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

function refineType() {
	// 全てのタイプを取得し、選択されたものだけ表示する
	var all_type_list = $('#type-form [name=type]').map(function(){return $(this).val();});

	var selected_type_list = $('#type-form [name=type]:checked').map(function(){return $(this).val();});
	var unselected_type_list = $(all_type_list).not(selected_type_list).get();

	$.each(selected_type_list, function(index, elem) {
		$('.' + elem).show();
	})

	$.each(unselected_type_list, function(index, elem) {
		$('.' + elem).hide();
	})
}
