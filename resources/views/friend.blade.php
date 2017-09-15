@extends('layouts.app')

@section('content')
<div class="container mb50 mt80 container_10">
    <div class="row" id="prof">
        <msg></msg>
        <div class="col-md-8 col-md-offset-2">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="post" action="{{ url('/room') }}">
                {{ csrf_field() }}
                <input type="hidden" name="from_user_id" value="{{ Auth::id() }}">
                <input type="hidden" name="to_user_id" value="{{ $user->id }}">
                <input type="submit" name="" value="メッセージを送る">
            </form>
            <div>
                <div>
                    <img src="{{ $user->img_path}}" class="thumb">
                </div>
            </div>
            <div>
                <h4 class="label_prof"><span>ニックネーム</span></h4>                
                <div class="form-group">
                    <p>{{ $user->name }}</p>
                </div>               
            </div>
            <div>
                <h4 class="label_prof"><span>お誕生日</span></h4>
                <div class="form-group">                                
                    <p>{{ $user->birthday }}</p>
                </div>
            </div>
            <div>
                <h4 class="label_prof"><span>性別</span></h4> 
                <div class="form-group">                                                             
                    @if($user->sex == 'male')
                    <p>男</p>
                    @else
                    <p>女</p>
                    @endif
                </div>
            </div>            
            <div>
                <h4 class="label_prof"><span>好きなアイドル</span></h4>
                <div class="form-group">
                    @foreach($user->idols as $idol)
                    <span class="tag_pink">{{ $idol->idol }}</span>
                    @endforeach
                </div>
            </div>
            <div>
                <h4 class="label_prof"><span>主な活動内容</span></h4>
                <div class="form-group">
                    @foreach($user->activities as $activity)
                    <span class="tag_grey">{{ $activity->activity }}</span>
                    @endforeach
                </div>
            </div>
            <div>
                <h4 class="label_prof"><span>推し</span></h4>              
                <div class="form-group">
                    @foreach($user->favorites as $favorite)
                    <span class="tag_pink">{{ $favorite->favorite }}</span>
                    @endforeach
                </div>
            </div> 
            <div>
                <h4 class="label_prof"><span>活動場所</span></h4>
                <div>
                    @foreach($user->regions as $region)
                    <p class="tag_grey">{{ $region->region }}</p>
                    @endforeach
                </div>
            </div>
            <div>
                <h4 class="label_prof"><span>繋がりたい人</span></h4>
                <div>                    
                    @foreach($statue_masters as $statue_master)
                    <p>
                        @if(in_array($statue_master->id,json_decode($statue_ids)))
                        <p>{{ $statue_master->statue }}</p>
                        @endif
                    </p>
                    @endforeach
                </div>
            </div>
            <div>
                <h4 class="label_prof"><span>参加予定イベント</span></h4>
                <div>
                    @foreach($user->events as $event)
                    <span>{{ $event->event }}</span>
                    @endforeach
                </div>
            </div>
            <div>
                <h4 class="label_prof"><span>自己紹介</span></h4>
                <div class="form-group">
                    <p>{{ $user->introduction }}</p>
                </div>
            </div>            
        </div>
    </div>
</div>
@endsection
