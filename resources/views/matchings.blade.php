@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>マッチング一覧</h1>
            @if(isset($friends))
            @foreach($friends as $friend)
            <div class="matching_friend">
                <a class="" href="{{ url('/profiles/'.$friend->id) }}">
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
                    </div>
                </a>
            </div>
            @endforeach
            @elseif(isset($m))
            <span>{{ $m }}</span>
            @endif
        </div>
    </div>
</div>
@endsection