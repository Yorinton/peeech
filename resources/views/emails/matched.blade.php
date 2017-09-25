<body>
	<div class="container">
		<h3><img class="friend_box" src="{{ $message->embed(url('/images/services/match.png')) }}"></h3>
		<p>{{ $user->name }}さんへ</p>
		<p>新しく{{ $friends_num }}人とマッチングしました!</br>
		   気の合いそうな人を見つけてメッセを送ってみましょう♬</p>
		<div class="friend_box">
			<p>
				<span>{{ $friend_ex->name }}</span></br>
				<span><img class="thumb" src="{{ $message->embed(url($friend_ex->img_path)) }}"></span></br>
				<span>{{ $friend_ex->introduction }}</span>
				<p>
					@foreach($friend_ex->idols as $idol)
					<span class="tag_pink">{{ $idol->idol }}</span>
					@endforeach
				</p>
			</p>
		</div>
		<p><a class="btn_link" href="http://homestead.app/matchings/{{ $user->id }}">他のマッチングをチェック♬</a></p>
	</div>
</body>
<style type="text/css">
	.catch_img {
		width: 100%;
	}
	.container {
		width:100%;
		text-align: center;
	}
	.tag_pink {
	    border-radius: 3px;
	    padding: 5px 7px;
	    font-size:11px;
		color: #fe66a4;
		border: 1px solid #fe66a4;
	}
	.friend_box {
		width: 80%;
		margin-left: 10%;
		margin-right: 10%;
		border:1px solid #eeeeee;
		border-radius: 5px;
		padding:10px;
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

</style>