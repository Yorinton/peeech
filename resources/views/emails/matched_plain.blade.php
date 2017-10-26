<body>
<div class="container">
    <h3><img class="catch_img" style="width:100%;" src="{{ $message->embed(url('/images/services/match.png')) }}"></h3>
    <p>{{ $user->name }}さんへ</p>
    <p class="pd5">新しく{{ $friends_num }}人とマッチング!<br>
        気の合いそうな人を見つけてメッセを送ってみましょう♬</p>
    <div class="friend_box">
        <p>
            <span>{{ $friend_ex->name }}</span><br>
        </p>
        <p class="pd5">
            @foreach($friend_ex->idols as $idol)
                <span class="tag_pink mb5 mr5 dis_inblo">{{ $idol->idol }}</span><br>
            @endforeach
        </p>
        <span class="introduction">{{ $friend_ex->introduction }}</span>
        </p>
    </div>
    <p><a class="btn_link" href="{{ $url }}">他のマッチングをチェック♬</a></p>
</div>
</body>