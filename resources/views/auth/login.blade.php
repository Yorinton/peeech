@extends('layouts.top')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2 text_align_c">
            <header class="header hero_img">
                <div class="wd100 ht100 header_content">
                    <div class="text_align_c">
                        <h1 class="concept_text">好きなアイドルでつながる<br>アイドルファン限定<br>友達作りサービス</h1>
                        <h2 class="service_logo"><img class="wd70" src="../../images/top/logo.png" alt="Peeech"></h2>
                        <div class="panel_sns wd100">
                            <div class="panel-body text_align_c sns_btn_container">
                                <a href="{{ url('/login/twitter') }}" class="btn btn-default btn-md wd_px250 mb10 btn_twitter"><img class="wd100" src="{{ asset('images/button/btn_twitter.png',$is_production) }}"></a>
                                <a href="{{ url('/login/facebook') }}" class="btn btn-primary btn-md wd_px250 btn_facebook"><img class="wd100" src="{{ asset('images/button/btn_facebook.png',$is_production) }}"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <section class="convert_to_max_size_of_page section_bg_color fc_white pl15 pr15">
                <h2 class="mt0 pt20 fs24 fw_b mb30">アイドルファン活動をより楽しくする出会い</h2>                
                <div class="mb30">
                    <p class="mb30">Peeechは、アイドルファンの「ファン同士でつながりたい」「一緒にこんなことをしてみたい」を実現し、ファン活動がより充実・楽しくなるアイドルファンに特化した友達作りサービスです。</p>
                    <img class="wd100" src="../../images/top/second_02.png">
                </div>
                <div>
                    <img class="wd90 mb20" src="../../images/top/second_01.png">
                </div>
                <div class="panel_sns_below">
                    <div class="panel-body text_align_c">
                        <a href="{{ url('/login/twitter') }}" class="btn btn-default btn-md wd100 mb10 btn_twitter"><img class="wd100" src="{{ asset('images/button/btn_twitter.png',$is_production) }}"></a>
                        <a href="{{ url('/login/facebook') }}" class="btn btn-primary btn-md wd100 btn_facebook"><img class="wd100" src="{{ asset('images/button/btn_facebook.png',$is_production) }}"></a>
                    </div>
                </div>
            </section>
            <section>
                <h3 class="fw_b mb35 mt35">こんなことありませんか？</h3>                
                <div class="mb50">
                    <img class="wd60 img_box_shadow" src="../../images/top/needs_01.png">
                    <p class="mt25 fs16 fw_b">共通点があって気の合うファン友と<br>一緒にファン活動を楽しみたい</p>
                </div>
                <div class="mb50">
                    <img class="wd60 img_box_shadow" src="../../images/top/needs_02.png">
                    <p class="mt25 fs16 fw_b">ライブや握手会楽しみ！<br>でもぼっち参加でちょっと寂しい</p>
                </div>
                <div class="mb50">
                    <img class="wd60 img_box_shadow" src="../../images/top/needs_03.png">
                    <p class="mt25 fs16 fw_b">友達募集や同行者募集するけど<br>中々声がかからない</p>
                </div>                
            </section>
            <section class="convert_to_max_size_of_page section_bg_color fc_white pl15 pr15 pb5">
                <h3 class="mb35 pt35 fw_b">Peeechなら</h3>
                <div>
                    <img class="wd60 img_box_shadow" src="../../images/top/miryoku_01.png">
                    <h4 class="fw_b mt20 mb20">あなたに合った<br>ファン友を見つけられる</h4>
                    <p class="mb40 pl15 pr15">プロフィールを解析し同じあなたに合ったファン仲間を自動でレコメンドします。待っているだけでファン友候補を見つけることが出来ます^^</p>
                </div>
                <div>
                    <img class="wd60 img_box_shadow" src="../../images/top/miryoku_02.png">
                    <h4 class="fw_b mt20 mb20">気の合ったファン友の中から<br>イベント同行者を探せる</h4>
                    <p class="mb40 pl15 pr15">普段から絡めるファン友を気軽に見つけられます。普段からアイドルトークで盛り上がったり、一緒にお茶したりしながら仲良くなればイベントやライブにも誘いやすくなります^^</p>
                </div>
                <div>
                    <img class="wd60 img_box_shadow" src="../../images/top/miryoku_03.png">
                    <h4 class="fw_b mt20 mb20">アイドルファン特化だから<br>友達や同行者を見つけやすい</h4>
                    <p class="mb40 pl15 pr15">通常のマッチングサービスやイベント同行者募集サービスと異なりアイドルファン特化型のため効率的にファン仲間と繋がれます</p>
                </div>
                <div class="panel_sns_below">
                    <div class="panel-body text_align_c">
                        <a href="{{ url('/login/twitter') }}" class="btn btn-default btn-md wd100 mb10 btn_twitter"><img class="wd100" src="{{ asset('images/button/btn_twitter.png',$is_production) }}"></a>
                        <a href="{{ url('/login/facebook') }}" class="btn btn-primary btn-md wd100 btn_facebook"><img class="wd100" src="{{ asset('images/button/btn_facebook.png',$is_production) }}"></a>
                    </div>
                </div>
            </section>
            <section>
                <h4 class="fw_b pt35 mb35 mt0 fs20">誘いやすさにこだわりました</h4>
                <div>
                    <img class="wd60 img_box_shadow" src="../../images/top/invite_01.png">
                    <h4 class="fw_b mt20 mb20 fs16">互いに興味を持った人とだけ<br>繋がれるから声もかけやすい</h4>
                    <p class="mb40 pl15 pr15">お互いに「興味あり」になった段階でマッチングのお知らせが届きます。相手も自分に興味を持ってくれているので安心して声をかけられます♬</p>
                </div>
                <div>
                    <img class="wd60 img_box_shadow" src="../../images/top/invite_02.png">
                    <h4 class="fw_b mt20 mb20 fs16">アイドルファン特化のプロフィールで<br>話のネタに困らない</h4>
                    <p class="mb40 pl15 pr15">「推し」「参加イベント」「活動歴」などアイドルファンに特化したプロフィールのため、プロフィールを見ながら色んな会話を楽しめます</p>
                </div>                                              
            </section>
            <section class="pt20 sepalator_top">
                <h3 class="fw_b mb35">Peeechの使い方</h3>
                <div>
                    <img class="wd60 img_box_shadow" src="../../images/top/use_01.png">
                    <h4 class="fw_b mt25 mb50">プロフィール入力後<br>希望に合った人をレコメンド</h4>
                </div>
                <div>
                    <img class="wd60 img_box_shadow" src="../../images/top/use_02.png">
                    <h4 class="fw_b mt25 mb50">興味ありor興味なしを選択</h4>
                </div>
                <div>
                    <img class="wd60 img_box_shadow" src="../../images/top/use_03.png">
                    <h4 class="fw_b mt25 mb30">マッチングしたら<br>メッセージを送ってみよう</h4>
                </div>
                <div class="text_align_c">
                    <img class="wd10" src="../../images/icons/arrow.png">
                </div>
                <div>
                    <h4 class="fw_b mt25 mb50 fs16">仲良くなったら一緒にオフ会したり<br>色んなファン活動を楽しもう</h4>
                </div>
                <div class="panel_sns_below">
                    <div class="panel-body text_align_c">
                        <a href="{{ url('/login/twitter') }}" class="btn btn-default btn-md wd100 mb10 btn_twitter"><img class="wd100" src="{{ asset('images/button/btn_twitter.png',$is_production) }}"></a>
                        <a href="{{ url('/login/facebook') }}" class="btn btn-primary btn-md wd100 btn_facebook"><img class="wd100" src="{{ asset('images/button/btn_facebook.png',$is_production) }}"></a>
                    </div>
                </div>
            </section>
            <section class="convert_to_max_size_of_page section_bg_color fc_white pl15 pr15 pb5">
                <h3 class="fw_b mb35 pt35">Peeechの想い</h3>
                <p class="fs18 fw_b mb40">アイドルファン・アイドルオタの<br>幸せな瞬間をもっと増やしたい</p>
                <p class="text_align_c lh30">好きなアイドルのライブで推しメンの輝く姿を見る、レスをもらう推しメンとの握手会で直接応援の言葉をかけたり二人だけの秘密の会話を楽しんだり。</p>
                <p class="text_align_c lh30">時には遠くまで何時間もかけて行って何時間も並ぶなどアイドルファン活動は大変な部分もあるけれどその先に待つ、楽しくて幸せな瞬間があると思います。</p>
                <p class="text_align_c lh30">私は以前はよく一人でライブハウスに行くことが多く大好きなアイドルに会える！というのはそれはそれで楽しいのですが、現場によっては馴染みにくかったり、一人で並んでいる最中寂しいな、好きなアイドルについてもっと誰かと共有したいなと感じることがありました。</p>
                <p class="text_align_c lh30">そんなあるときから、SNSでつながったとあるオタク友達のおかげで仲間達と好きなアイドルについて語り合ったり一緒にライブ同行・握手連番、時には遠征などをするようになりすごく楽しい時間を過ごしたのです。</p>
                <p class="text_align_c lh30">「アイドルに会いに行く・アイドルとの時間を楽しむ」もちろんそれが大きな目的ではありましたが「仲間たちに会いに行く」というのも一つの楽しみになっていったのです。</p>
                <p class="text_align_c lh30">そんな経験から、ファン活動を誰かと一緒にもっと楽しめ幸せな瞬間をより増やせるといいな、と思いこのサービスを個人的に作っています。</p>
                <p class="text_align_c lh30">もちろん、「ファン活動を一人で楽しむ」というのもいいものだと思います。</p>
                <p class="text_align_c lh30">ただ、時々、ほんの少しの時間でも「誰かと一緒にその場を楽しむ」…そんな時間もあってもいいのかもしれません。</p>
                <p class="text_align_c lh30">ぜひPeeechで沢山の楽しい思い出を作ってください＾＾</p>
            </section>
            <footer class="pt20">
                <div>
                    <p>ドルヲタが有志で作ってます♬</p>
                    <p>©︎2017 Peeech.com</p>
                </div>
            </footer>
        </div>
    </div>
</div>
@endsection
