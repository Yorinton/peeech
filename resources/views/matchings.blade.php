@extends('layouts.app')

@section('content')
<div class="container mb50 mt50">
    <div class="row">
        <div class="col-md-8 col-md-offset-2 mt10">
            @if(isset($friends))
            @foreach($friends as $friend)
            <div class="matching_friend">
                <a class="" href="{{ url('/friend/'.$user->id.'/'.$friend->id) }}">
                    <div class="of_h pt10 pb10 list_border">
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