@extends('layouts.app')

@section('content')
<div class="container mb50 mt50">
    <div class="row">
        <div class="col-md-8 col-md-offset-2 mt10">
            @if(isset($friends))
            @foreach($friends as $friend)
            <div class="matching_friend">
                <!-- <a> -->
                <div class="of_h pt10 pb10 list_border to_room">
                    <img class="thumb_middle" src="{{ $friend->img_path}}">
                    <div class="fr wd70">
                        <p class="mb0 fw_b text_clamp_s fs15">{{ $friend->name }}</p>
                        <p class="mb0 fs13">{{ $friend->birthday }} / {{ $friend->sex}} / 
                            @foreach($friend->regions as $region)
                            <span>{{ $region->region }}</span>
                            @endforeach
                        </p>
                        <p class="mb0 text_clamp_m fs10">{{ $friend->introduction}}</p>
                    </div>
                    <form method="post" action="{{ url('/room') }}" class="disnone make_room">
                        {{ csrf_field() }}
                        <input type="hidden" name="from_user_id" value="{{ Auth::id() }}">
                        <input type="hidden" name="to_user_id" value="{{ $friend->id }}">
                        <input type="submit" name="" value="メッセージを送る">
                    </form>
                </div>
                <!-- </a> -->
            </div>
            @endforeach
            @elseif(isset($m))
            <span>{{ $m }}</span>
            @endif
        </div>
    </div>
</div>
@endsection