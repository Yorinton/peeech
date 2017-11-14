@extends('layouts.app')

@section('content')
<div class="container pb50 mt50 pt15 ht100 card_container">
    <div class="row ht100">
        <div class="col-md-8 col-md-offset-2 ht100">
            @if(isset($m))
            <span class="msg_error">{{ $m }}</span>
            @endif
            @if(isset($friends))
                @foreach($friends as $friend)
                <div class="card card_shadow mb10 ht80 disnone">
                    <div class="mb10 disfle">
                        <img class="thumb ml5p" src="{{ $friend->img_path }}">
                        <div class="basic_info wd55 ml5p mr_a">
                            <p class="name">
                                <span class="fw_b text_clamp_m">{{ $friend->name }}</span>
                                <span>{{ $friend->birthday }}</span>
                                <span>{{ $friend->sex }}</span><br>
                            @foreach($friend->regions as $region)
                            <span>{{ $region->region }}</span>
                            @endforeach
                            </p>
                        </div>
                    </div>
                    <div class="introduction">
                        <div class="tag_container mt5">
                            <p class="idol mb0">
                                @foreach($friend->idols as $idol)
                                <span class="idol_name tag_pink dis_inblo mb5">{{ $idol->idol }}</span>
                                @endforeach
                            </p>
                        </div>
                        @if(count($friend->activities)>0)
                        <div class="tag_container mb10">
                            <p class="activity mb0">
                                @foreach($friend->activities as $activity)
                                <span class="activity_name tag_grey dis_inblo mb5">{{ $activity->activity }}</span>
                                @endforeach
                            </p>
                        </div>
                        @endif
                        <div class="introduction_sentents">
                            <p>{{ $friend->introduction }}</p>
                        </div>
                        <p class="profile_link mt5">
                            <a href="{{ url('/friend/'.Auth::id().'/'.$friend->id) }}">
                                もっと見る
                                <img src="">
                            </a>
                        </p>
                    </div>
                    <div class="form-group disfle btn_judge_container">
                        <form class="mr10 wd50" method="post" action="{{ url('/matchings/'.$id) }}">
                            {{ csrf_field() }}
                            <input class="form-control" type="hidden" name="to_user_id" value="{{ $friend->id }}">
                            <input class="form-control negativeBtn fs18 lh22" type="submit" name="not_interest" value="興味なし">
                        </form>
                        <form class="wd50" method="post" action="{{ url('/matchings/'.$id) }}">
                            {{ csrf_field() }}
                            <input class="form-control" type="hidden" name="to_user_id" value="{{ $friend->id }}">
                            <input class="form-control submitBtn fs18 lh22" type="submit" name="interest" value="興味あり">
                        </form>                
                    </div>
                </div>
                @endforeach
            @endif
            <div class="card card_no_match mb10 ht80 disnone">
                @if(isset($wait_img_path))
                <img class="wd100" src="{{ $wait_img_path }}">
                @endif
            </div>
        </div>
    </div>
</div>
@endsection