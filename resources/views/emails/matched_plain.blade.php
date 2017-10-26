{{ $user->name }}さんへ

マッチングおめでとうございます！

新しく{{ $friends_num }}人とマッチング!
気の合いそうな人を見つけてメッセを送ってみましょう♬

＜ファン友候補(1人目)＞
ニックネーム：{{ $friend_ex->name }}
好きなアイドル：
@foreach($friend_ex->idols as $idol)
    {{ $idol->idol }}
@endforeach
自己紹介文：
{{ $friend_ex->introduction }}

↓↓↓マッチングしたファン友候補をチェック♬↓↓↓
{{ $url }}">


Peeech.com