$(function(){ //即時関数にすることで外から中の変数を参照出来ないようにする

	// プロフィール情報登録
	// 追加された要素数
	var size;

	//好きなアイドル
	$(".btn-idol").on("click",function(){
		var idolName = $(".disblo").val();
		if(idolName !== ""){
			$(".del_idol").after("<div class='added_idol_container tag_pink mr5 mb5'><span class='del_idol_btn'>×</span><span class='added_idol'>" + idolName + "</span><input type='hidden' name='added_idol[]' value='" + idolName + "'></div>");
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

	//メッセージ一覧ページの各メッセージクリック
	$(".to_room").each(function(){
		$(this).click(function(){
			var form = $(this).children('.make_room').submit();
		});
	});

	//性別選択
	$(".sex_label").on('click',function(){
		if($(this).attr('for') === 'female'){
			$('.tag_blue').removeClass('tag_blue');
			$(this).addClass('tag_pink');
		}else{
			$('.tag_pink').removeClass('tag_pink');
			$(this).addClass('tag_blue');
		}
	});
	//利用目的選択
	$(".checkbox_1").on('click',function(){
		if($(".img_checkbox_1").attr('src') === '../../images/icons/no_checked.png'){
			$(".img_checkbox_1").attr('src','../../images/icons/checked.png');
		}else {
			$(".img_checkbox_1").attr('src','../../images/icons/no_checked.png');
		}
	});
	$(".checkbox_2").on('click',function(){
		if($(".img_checkbox_2").attr('src') === '../../images/icons/no_checked.png'){
			$(".img_checkbox_2").attr('src','../../images/icons/checked.png');
		}else {
			$(".img_checkbox_2").attr('src','../../images/icons/no_checked.png');
		}
	});
	$(".checkbox_3").on('click',function(){
		if($(".img_checkbox_3").attr('src') === '../../images/icons/no_checked.png'){
			$(".img_checkbox_3").attr('src','../../images/icons/checked.png');
		}else {
			$(".img_checkbox_3").attr('src','../../images/icons/no_checked.png');
		}
	});
	$(".checkbox_4").on('click',function(){
		if($(".img_checkbox_4").attr('src') === '../../images/icons/no_checked.png'){
			$(".img_checkbox_4").attr('src','../../images/icons/checked.png');
		}else {
			$(".img_checkbox_4").attr('src','../../images/icons/no_checked.png');
		}
	});
	//利用登録画面のみメニューボタン非表示
	if($(location).attr('pathname').match(/^.*registerpage.*$/)){
		$('.navbar-toggle').attr('style','display:none');
	}
});
