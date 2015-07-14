$(document).ready(function () {

	// PHPから何を元にソートするかを取得
	var script = $('#script');
	var sort = JSON.parse(script.attr('data-string'));
	changeColor(sort);


	// setInterval(function() {
 //        $.ajax({
 //            type: 'GET',
 //            url: '/check.php',
 //            cache: false,
 //            dataType: 'text',
 //            success: function(data) {
 //                document.getElementById('after').style.display = "block";
 //                $('#after_detail').html(data);
 //            },
 //            error: function() {
 //                alert("読み込み失敗");
 //            }
 //        });
 //    }, 3000);
	
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
