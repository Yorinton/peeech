@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>メッセージ一覧</h1>
            @if(isset($friends))
            @foreach($friends as $friend)
            <div class="matching_friend">
                <div>
                    <img src="">
                </div>
                <div>
                    <p>名前{{ $friend->name }}<span>{{ $friend->birthday }}</span></p>
                    <p>
                        @foreach($friend->idols as $idol)
                        <span>{{ $idol->idol }}</span>
                        @endforeach
                        <span>他</span>
                    </p>
                    <form method="post" action="{{ url('/room') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="from_user_id" value="{{ Auth::id() }}">
                        <input type="hidden" name="to_user_id" value="{{ $friend->id }}">
                        <input type="submit" name="" value="メッセージを送る">
                    </form>
                </div>
            </div>
            @endforeach
            @elseif(isset($m))
            <span>{{ $m }}</span>
            @endif
        </div>
    </div>
</div>
@endsection