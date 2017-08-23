<p>今日のマッチング</p>
<p>{{ $user->name }}さんへ</p>
<p>新しく{{ $friends_num }}人とマッチングしました</p>
<p>気の合いそうな人を見つけてメッセを送ってみましょう♬</p>
<p>
	<span>{{ $friend_ex->name }}</span>
	<span>{{ $friend_ex->introduction }}</span>
	@foreach($friend_ex->idols as $idol)
	<span>{{ $idol->idol }}</span>
	@endforeach
</p>
<p><a href="http://dev.peeech.com/matchings/{{ $user->id }}">他のマッチングを見る</a>></p>