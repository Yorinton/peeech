@extends('layouts.app')

@section('content')
<div class="container mb50">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @if(isset($m))
            <span>{{ $m }}</span>
            @endif
            @if(isset($friends))
                @foreach($friends as $friend)
                <div class="card mb10">
                    <div class="sp-around mb10">
                        <img class="thumb" src="{{ $friend->img_path }}">
                        <div class="basic_info">
                            <p class="name">{{ $friend->name }}<br>
                            23歳 / {{ $friend->sex }} / 
                            @foreach($friend->regions as $region)
                            <span>{{ $region->region }}</span>
                            @endforeach
                            </p>
                        </div>
                    </div>
                    <div class="introduction">
                        <div>
                            <p class="idol mb0">
                                @foreach($friend->idols as $idol)
                                <span class="idol_name tag_pink dis_inblo mb5">{{ $idol->idol }}</span>
                                @endforeach
                            </p>
                        </div>
                        <div>
                            <p class="activity mb0">
                                @foreach($friend->activities as $activity)
                                <span class="activity_name tag_grey dis_inblo mb5">{{ $activity->activity }}</span>
                                @endforeach
                            </p>
                        </div>                        
                        <div class="introduction_sentents">
                            <p>{{ $friend->introduction }}</p>
                        </div>
                        <p class="profile_link">
                            <a href="{{ url('/profiles/'.$friend->id) }}">
                                もっと見る
                                <img src="">
                            </a>
                        </p>
                    </div>
                    <div class="form-group disfle">
                        <form class="mr10 wd50" method="post" action="{{ url('/matchings/'.$id) }}">
                            {{ csrf_field() }}
                            <input class="form-control" type="hidden" name="to_user_id" value="{{ $friend->id }}">
                            <input class="form-control negativeBtn" type="submit" name="not_interest" value="興味なし">
                        </form>
                        <form class="wd50" method="post" action="{{ url('/matchings/'.$id) }}">
                            {{ csrf_field() }}
                            <input class="form-control" type="hidden" name="to_user_id" value="{{ $friend->id }}">
                            <input class="form-control submitBtn" type="submit" name="interest" value="興味あり">
                        </form>                
                    </div>
                </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
@endsection