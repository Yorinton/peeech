@extends('layouts.app')

@section('content')
<div class="container mb50 mt45">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @if(isset($friends))     
            <div class="convert_to_max_size_of_page">
                <img class="wd100" src="../../images/services/match.png">
            </div>            
            @foreach($friends as $friend)
            <div class="matching_friend">
                <a class="" href="{{ url('/friend/'.Auth::id().'/'.$friend->id) }}">
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
            <span class="msg_error">{{ $m }}</span>
            @endif
        </div>
    </div>
</div>
@endsection