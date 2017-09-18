@extends('layouts.app')

@section('content')
<div class="container mb50 pt10 container_10 card_container">
    <div class="row" id="prof">
        <msg></msg>
        <div class="sp-between pb10 top_bar">
            <p class="link_back"><a href="{{ $backUrl }}">戻る</a></p>
            @if($hasMatched)
            <form method="post" action="{{ url('/room') }}" class="fr">
                {{ csrf_field() }}
                <input type="hidden" name="from_user_id" value="{{ Auth::id() }}">
                <input type="hidden" name="to_user_id" value="{{ $user->id }}">
                <input type="submit" name="submit" class="btn inputBaseStyle submitBtn mr20" value="メッセージを送る">
            </form>
            @endif
        </div>
        <div class="col-md-8 col-md-offset-2 card_detail mb10 mt55">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="disfle mb20">
                <div>
                    <div>
                        <img src="{{ $user->img_path}}" class="thumb">
                    </div>
                </div>
                <div>
                    <div class="form-group">
                        <span class="fw_b text_clamp_m">{{ $user->name }}</span>
                        <span>{{ $user->birthday }}</span>
                        <span>{{ $user->sex }}</span>
                        @foreach($user->regions as $region)
                        <p>{{ $region->region }}</p>
                        @endforeach                                      
                    </div>               
                </div>
            </div>       
            <div class="mb20">
                <div class="form-group wrap">
                    @foreach($user->idols as $idol)
                    <span class="tag_pink mr5 mb5">{{ $idol->idol }}</span>
                    @endforeach
                </div>
            </div>
            <div class="mb20 separator">
                <div class="form-group">
                    <p>{{ $user->introduction }}</p>
                </div>
            </div>
            <div class="mb20 separator">
                <label class="label_prof wd100 mb15"><span>推し</span></label>              
                <div class="form-group wrap">
                    @foreach($user->favorites as $favorite)
                    <span class="tag_pink mr5 mb5">{{ $favorite->favorite }}</span>
                    @endforeach
                </div>
            </div>             
            <div class="mb20 separator">
                <label class="label_prof wd100 mb15"><span>主な活動内容</span></label>
                <div class="form-group wrap">
                    @foreach($user->activities as $activity)
                    <span class="tag_grey mr5 mb5">{{ $activity->activity }}</span>
                    @endforeach
                </div>
            </div>
            <div class="mb20 separator">
                <label class="label_prof wd100 mb15"><span>繋がりたい人</span></label>
                <div class="wrap form-group">                   
                    @foreach($statue_masters as $statue_master)
                        @if(in_array($statue_master->id,json_decode($statue_ids)))
                        <span class="tag_grey mr5 mb5">{{ $statue_master->statue }}</span>
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="mb20 separator">
                <label class="label_prof wd100 mb15"><span>参加予定イベント</span></label>
                <div class="wrap form-group">
                    @foreach($user->events as $event)
                    <span class="tag_pink mr5 mb5">{{ $event->event }}</span>
                    @endforeach
                </div>
            </div>          
        </div>
    </div>
</div>
@endsection
