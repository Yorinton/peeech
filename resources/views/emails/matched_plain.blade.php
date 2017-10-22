<body>
<div class="container">
    <h3><img class="catch_img" src="{{ $message->embed(url('/images/services/match.png')) }}"></h3>
    <p>{{ $user->name }}さんへ</p>
    <p class="pd5">新しく{{ $friends_num }}人とマッチング!</br>
        気の合いそうな人を見つけてメッセを送ってみましょう♬</p>
    <div class="friend_box">
        <p>
            <span>{{ $friend_ex->name }}</span></br>
            <span><img class="thumb" src="{{ $message->embed(url($friend_ex->img_path)) }}"></span></br>
        <p class="pd5">
            @foreach($friend_ex->idols as $idol)
                <span class="tag_pink mb5 mr5 dis_inblo">{{ $idol->idol }}</span>
            @endforeach
        </p>
        <span class="introduction">{{ $friend_ex->introduction }}</span>
        </p>
    </div>
    <p><a class="btn_link" href="{{ $url }}">他のマッチングをチェック♬</a></p>
</div>
</body>
<style type="text/css">
    .catch_img {
        width: 90%;
        margin-left: 5%;
        margin-right: 5%;
        /*border:1px solid #eeeeee;*/
        border-radius: 5px;
    }
    .container {
        width:100%;
        text-align: center;
    }
    .tag_pink {
        border-radius: 3px;
        padding: 5px 7px;
        font-size:15px;
        color: #fe66a4;
        border: 1px solid #fe66a4;
    }
    .friend_box {
        width: 100%;
        /*margin-left: 10%;*/
        /*margin-right: 10%;*/
        border:1px solid #eeeeee;
        border-radius: 5px;
        /*padding:10px;*/
    }
    .pd5 {
        padding:0 5%;
    }
    .introduction {
        display: inline-block;
        padding: 0 5%;
    }
    .btn_link {
        padding: 20px;
        background: #fe66a4;
        border-radius: 5px;
        margin-top: 15px;
        display: inline-block;
        text-decoration: none;
        color: white;
        box-shadow: 0 0 10px #fe66a4;
    }
    .thumb {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 50%;
    }
    .mb5 {
        margin-bottom: 5px;
    }
    .mr5 {
        margin-right: 5px;
    }
    .dis_inblo {
        display:inline-block;
    }

</style>