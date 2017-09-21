@extends('layouts.top')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2 pt20 text_align_c">
            <header class="header hero_img">
                <div class="wd100 ht100 header_content">
                    <div class="text_align_c">
                        <h1 class="fs18">好きなアイドルでつながる<br>アイドルファン限定<br>友達作りサービス</h1>
                        <h2><img class="wd80" src="../../images/top/logo.png" alt="Peeech"></h2>
                    </div>
                    <div class="panel">
                        <div class="panel-body text_align_c">    
                            <a href="{{ url('/login/twitter') }}" class="btn btn-default btn-md wd100 mb10">Twitterで登録・ログイン</a>
                            <a href="{{ url('/login/facebook') }}" class="btn btn-primary btn-md wd100">Facebookで登録・ログイン</a>
                        </div>
                    </div>
                </div>
            </header>
            <section class="mt300">
                <h2>アイドルファン活動をより楽しくする出会い</h2>                
                <div>
                    <p>Peeechは、アイドルファンの「ファン同士でつながりたい」「一緒にこんなことをしてみたい」を実現し、ファン活動がより充実・楽しくなるアイドルファンに特化した友達作りサービスです。</p>
                    <img class="wd80" src="../../images/top/second_01.png">
                </div>
                <div>
                    <img class="wd80" src="../../images/top/second_02.png">
                </div>
            </section>
            <section>
                <h3>こんなことありませんか？</h3>                
                <div>
                    <img class="wd80" src="../../images/top/needs_01.png">
                    <p>共通点があって気の合うファン友と<br>一緒にファン活動を楽しみたい</p>
                </div>
                <div>
                    <img class="wd80" src="../../images/top/needs_02.png">
                    <p>ライブや握手会楽しみ！<br>でもぼっち参加でちょっと寂しい</p>
                </div>
                <div>
                    <img class="wd80" src="../../images/top/needs_03.png">
                    <p>友達募集や同行者募集するけど<br>中々声がかからない</p>
                </div>                
            </section>
            <section>
                <h3>Peeechなら</h3>
                <div>
                    <img class="wd80" src="../../images/top/miryoku_01.png">
                    <h4>あなたに合った<br>ファン友を見つけられる</h4>
                    <p>プロフィールを解析し同じあなたに合ったファン仲間を自動でレコメンドします。待っているだけでファン友候補を見つけることが出来ます^^</p>
                </div>
                <div>
                    <img class="wd80" src="../../images/top/miryoku_02.png">
                    <h4>気の合ったファン友の中から<br>イベント同行者を探せる</h4>
                    <p>普段から絡めるファン友を気軽に見つけられます。普段からアイドルトークで盛り上がったり、一緒にお茶したりしながら仲良くなればイベントやライブにも誘いやすくなります^^</p>
                </div>
                <div>
                    <img class="wd80" src="../../images/top/miryoku_03.png">
                    <h4>アイドルファン特化だから<br>友達や同行者を見つけやすい</h4>
                    <p>通常のマッチングサービスやイベント同行者募集サービスと異なりアイドルファン特化型のため効率的にファン仲間と繋がれます</p>
                </div>                                              
            </section>
            <section>
                <h3>誘いやすさにこだわりました</h3>
                <div>
                    <img class="wd80" src="../../images/top/invite_01.png">
                    <h4>互いに興味を持った人とだけ<br>繋がれるから声もかけやすい</h4>
                    <p>お互いに「興味あり」になった段階でマッチングのお知らせが届きます。相手も自分に興味を持ってくれているので安心して声をかけられます♬</p>
                </div>
                <div>
                    <img class="wd80" src="../../images/top/invite_02.png">
                    <h4>アイドルファン特化のプロフィールで<br>話のネタに困らない</h4>
                    <p>「推し」「参加イベント」「活動歴」などアイドルファンに特化したプロフィールのため、プロフィールを見ながら色んな会話を楽しめます</p>
                </div>                                              
            </section>
            <section>
                <h3>Peeechの使い方</h3>
                <div>
                    <img class="wd80" src="../../images/top/use_01.png">
                    <h4>プロフィール入力後<br>希望に合った人をレコメンド</h4>
                </div>
                <div>
                    <img class="wd80" src="../../images/top/use_02.png">
                    <h4>興味ありor興味なしを選択</h4>
                </div>
                <div>
                    <img class="wd80" src="../../images/top/use_03.png">
                    <h4>マッチングしたら<br>メッセージを送ってみよう</h4>
                </div>
                <div>
                    <img src="">
                </div>
                <div>
                    <p>仲良くなったら一緒にオフ会したり<br>色んなファン活動を楽しもう</p>
                </div>                       
            </section>
            <section>
                <h3>Peeechの想い</h3>
                <p>アイドルファン・アイドルオタの<br>幸せな瞬間をもっと増やしたい</p>
                <p></p>
            </section>
            <footer>
                <div>
                    <p>ドルヲタが有志で作ってます♬</p>
                    <p>©︎2017 Peeech.com</p>
                </div>
            </footer>
        </div>
    </div>
</div>
@endsection
