$(function () {
    //即時関数にすることで外から中の変数を参照出来ないようにする

    // プロフィール情報登録
    // 追加された要素数
    var size;

    //好きなアイドル
    $(".btn-idol").on("click", function () {
        var idolName = $(".disblo").val();
        var idolId = $(".disblo > option:selected").data('num');
        if (idolName !== "") {
            $(".del_idol").after("<div class='added_idol_container tag_pink mr5 mb5'><span class='del_idol_btn'>×</span><span class='added_idol'>" + idolName + "</span><input type='hidden' name='added_idol[]' value='" + idolId + "'></div>");
            size = $(".added_idol_container").length;
            var i;
            for (i = 2; i < size + 2; i++) {
                $(document).on("click", ".added_idol_container:nth-child(" + i + ")", function () {
                    $(this).remove();
                });
            }
        }
    });

    //oldで表示されているアイドルのタグに適用するイベント
    $(".added_idol_container").on("click",function(){
        $(this).remove();
    });

    //推し
    $(".btn-favorite").on("click", function () {
        var txt = $(".form-favorite").val();
        if (txt !== "") {
            $(".del_favorite").after("<div class='added_favorite_container'><span class='del_favorite_btn'>×</span><span class='added_favorite'>" + txt + "</span><input type='hidden' name='added_favorite[]' value='" + txt + "'></div>");
            size = $(".added_favorite_container").length;
            var i;
            for (i = 2; i < size + 2; i++) {
                $(document).on("click", ".added_favorite_container:nth-child(" + i + ")", function () {
                    $(this).remove();
                });
            }
        }
    });
    //参加予定イベント
    $(".btn-event").on("click", function () {
        var txt = $(".form-event").val();
        if (txt !== "") {
            $(".del_event").after("<div class='added_event_container'><span class='del_favorite_btn'>×</span><span class='added_event'>" + txt + "</span><input type='hidden' name='added_event[]' value='" + txt + "'></div>");
            size = $(".added_event_container").length;
            var i;
            for (i = 2; i < size + 2; i++) {
                $(document).on("click", ".added_event_container:nth-child(" + i + ")", function () {
                    $(this).remove();
                });
            }
        }
    });

    //メッセージ一覧ページの各メッセージクリック
    $(".to_room").each(function () {
        $(this).click(function () {
            var form = $(this).children('.make_room').submit();
        });
    });

    //性別選択
    $(".sex_label").on('click', function () {
        if ($(this).attr('for') === 'female') {
            $('label.tag_blue').removeClass('tag_blue');
            $(this).addClass('tag_pink');
        } else {
            $('label.tag_pink').removeClass('tag_pink');
            $(this).addClass('tag_blue');
        }
    });


    if($('p.purpose_id:nth-child(1)').text() === '2') {
        console.log('本番');
        //利用目的選択
        $(".checkbox_2").on('click', function () {
            if ($(".img_checkbox_2").attr('src') === '../../images/icons/no_checked.png') {
                $(".img_checkbox_2").attr('src', '../../images/icons/checked.png');
            } else {
                $(".img_checkbox_2").attr('src', '../../images/icons/no_checked.png');
            }
        });
        $(".checkbox_12").on('click', function () {
            if ($(".img_checkbox_12").attr('src') === '../../images/icons/no_checked.png') {
                $(".img_checkbox_12").attr('src', '../../images/icons/checked.png');
            } else {
                $(".img_checkbox_12").attr('src', '../../images/icons/no_checked.png');
            }
        });
        $(".checkbox_22").on('click', function () {
            if ($(".img_checkbox_22").attr('src') === '../../images/icons/no_checked.png') {
                $(".img_checkbox_22").attr('src', '../../images/icons/checked.png');
            } else {
                $(".img_checkbox_22").attr('src', '../../images/icons/no_checked.png');
            }
        });
        $(".checkbox_32").on('click', function () {
            if ($(".img_checkbox_32").attr('src') === '../../images/icons/no_checked.png') {
                $(".img_checkbox_32").attr('src', '../../images/icons/checked.png');
            } else {
                $(".img_checkbox_32").attr('src', '../../images/icons/no_checked.png');
            }
        });
    }else if($('p.purpose_id:nth-child(1)').text() === '1'){
        console.log('ローカル');
        //利用目的選択
        $(".checkbox_1").on('click', function () {
            if ($(".img_checkbox_1").attr('src') === '../../images/icons/no_checked.png') {
                $(".img_checkbox_1").attr('src', '../../images/icons/checked.png');
            } else {
                $(".img_checkbox_1").attr('src', '../../images/icons/no_checked.png');
            }
        });
        $(".checkbox_2").on('click', function () {
            if ($(".img_checkbox_2").attr('src') === '../../images/icons/no_checked.png') {
                $(".img_checkbox_2").attr('src', '../../images/icons/checked.png');
            } else {
                $(".img_checkbox_2").attr('src', '../../images/icons/no_checked.png');
            }
        });
        $(".checkbox_3").on('click', function () {
            if ($(".img_checkbox_3").attr('src') === '../../images/icons/no_checked.png') {
                $(".img_checkbox_3").attr('src', '../../images/icons/checked.png');
            } else {
                $(".img_checkbox_3").attr('src', '../../images/icons/no_checked.png');
            }
        });
        $(".checkbox_4").on('click', function () {
            if ($(".img_checkbox_4").attr('src') === '../../images/icons/no_checked.png') {
                $(".img_checkbox_4").attr('src', '../../images/icons/checked.png');
            } else {
                $(".img_checkbox_4").attr('src', '../../images/icons/no_checked.png');
            }
        });
    }
    //利用登録画面のみメニューボタン非表示
    if ($(location).attr('pathname').match(/^.*registerpage.*$/)) {
        $('.navbar-toggle').attr('style', 'display:none');
        $('.phonetic').on('change', function () {
            var num = $(this).val();
            $('.disblo').addClass('disnone').attr('name', '').removeClass('disblo');
            $("#idols_" + num).addClass('disblo').removeClass('disnone').attr('name', 'idol');
        });
    }
    if ($(location).attr('pathname').match(/^.*friend\/.*$/)) {
        //エラーの場合はnavbarは表示
        if ($('.msg_error').length > 0) {
            return;
        }
        $('.navbar').addClass('disnone');
        // $('.container').removeClass('mt80').addClass('mt20');
    }
    if ($(location).attr('pathname').match(/^.*room\/.*$/)) {
        $('.navbar-toggle').addClass('disnone');
        $('footer').addClass('disnone');
        // $('.container').removeClass('mt80').addClass('mt20');
    }
    //メニューボタン出しわけ
    if ($(location).attr('pathname').match(/^.*friends\/.*$/)) {
        $('.menu1').attr('src', '../../images/icons/menu_color/menu1.png');
    }
    if ($(location).attr('pathname').match(/^.*matchings\/.*$/)) {
        $('.menu2').attr('src', '../../images/icons/menu_color/menu2.png');
    }
    if ($(location).attr('pathname').match(/^.*rooms\/.*$/)) {
        $('.menu3').attr('src', '../../images/icons/menu_color/menu3.png');
    }
    if ($(location).attr('pathname').match(/^.*profiles\/.*$/)) {
        $('.menu4').attr('src', '../../images/icons/menu_color/menu4.png');
    }

    //画像ファイルプレビュー表示のイベント追加 fileを選択時に発火するイベントを登録
    $('.thumb_form').on('change', 'input[type="file"]', function (e) {
        var file = e.target.files[0],
            reader = new FileReader(),
            $preview = $(".preview");
        t = this;

        // 画像ファイル以外の場合は何もしない
        if (file.type.indexOf("image") < 0) {
            return false;
        }

        // ファイル読み込みが完了した際のイベント登録
        reader.onload = function (file) {
            return function (e) {
                //既存のプレビューを削除
                $preview.empty();
                // .prevewの領域の中にロードした画像を表示するimageタグを追加
                $preview.attr({
                    src: e.target.result,
                    title: file.name
                });
            };
        }(file);

        reader.readAsDataURL(file);
    });
    //cardの高さ設定
    if ($('.card').length > 0) {
        var ht_w = $(window).height();
        // var ht_card = ht_w * 0.727;
        var ht_card = ht_w - 157;
        var ht_text = ht_w - 430;
        $('.card').height(ht_card);
        $('.introduction_sentents').height(ht_text);
        $('.card:first-child').removeClass('disnone');
    }

    if ($('#slider-pro').length > 0) {

        var ht_w = $(window).height();
        var ht_card = ht_w - 40;

        //スライド
        $('#slider-pro').sliderPro({
            buttons: true, //スライダーのページャを表示する
            startSlide: 0, //最初のスライドを指定する
            arrows: false, //左右の矢印ボタンを表示する
            width: '90%', //横幅を設定する
            height: ht_card, //高さを設定する
            autoplay: false, //自動再生の設定
            loop: false, //スライドをループさせる設定
            visibleSize: '0%', //前後のスライドを表示するかの設定
            forceSize: 'fullWidth' //スライダーの幅をブラウザ幅に設定する
        });
    }

    if ($('#slider-pro').length > 0) {
        $('.btn_close').on('click', function () {
            $('#slider-pro').removeClass('disblo');
            $('#slider-pro').addClass('disnone');
        });
    }
});