$(function(){ //即時関数にすることで外から中の変数を参照出来ないようにする
	// プロフィール情報登録
	// 追加された要素数
	var size;

	//好きなアイドル
	$(".btn-idol").on("click",function(){
		var idolName = $(".disblo").val();
		if(idolName !== ""){
			$(".del_idol").after("<div class='added_idol_container'><span class='del_idol_btn'>×</span><span class='added_idol'>" + idolName + "</span><input type='hidden' name='added_idol[]' value='" + idolName + "'></div>");
			size = $(".added_idol_container").length;
			var i;
			for(i=2;i < size + 2;i++){
				$(document).on("click",".added_idol_container:nth-child(" + i +")",function(){
					$(this).remove();
				});
			}
		}	
	});
	//推し
	$(".btn-favorite").on("click",function(){
		var txt = $(".form-favorite").val();
		if(txt !== ""){	
			$(".del_favorite").after("<div class='added_favorite_container'><span class='del_favorite_btn'>×</span><span class='added_favorite'>" + txt + "</span><input type='hidden' name='added_favorite[]' value='" + txt + "'></div>");
			size = $(".added_favorite_container").length;
			var i;
			for(i=2;i < size + 2;i++){
				$(document).on("click",".added_favorite_container:nth-child(" + i +")",function(){
					$(this).remove();
				});
			}
		}
	});
	//参加予定イベント
	$(".btn-event").on("click",function(){
		var txt = $(".form-event").val();
		if(txt !== ""){
			$(".del_event").after("<div class='added_event_container'><span class='del_favorite_btn'>×</span><span class='added_event'>" + txt + "</span><input type='hidden' name='added_event[]' value='" + txt + "'></div>");
			size = $(".added_event_container").length;
			var i;
			for(i=2;i < size + 2;i++){
				$(document).on("click",".added_event_container:nth-child(" + i +")",function(){
					$(this).remove();
				});
			}
		}
	});
	//50音別アイドル一覧表示
	$("select.form-control.phonetic").change(function(){
		var num = $(this).val();
		$('.disblo').addClass('disnone').attr('name','').removeClass('disblo');
		$("#idols_" + num).addClass('disblo').removeClass('disnone').attr('name','idol');
	});

});
