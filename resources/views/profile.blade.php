@extends('layouts.app')

@section('content')
<div class="container mb50 mt80 container_10">
    <div class="row" id="prof">
        <msg></msg>
        <div class="col-md-8 col-md-offset-2">
        @if(Auth::id() === $user->id) 
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div>
                <div class="thumb_container">
                    <img class="thumb" src="{{ $user->img_path }}">
                    <form class="form-group thumb_form" method="post" action="{{ url('/users/'.$user->id) }}" enctype="multipart/form-data" files='true'>
                    {{ csrf_field() }}                
                    {{ method_field('PATCH') }}                     
                        <input type="file" name="img_path">
                        <input type="submit" value="変更">
                    </form>
                </div>
            </div>
            <prof-name v-bind:user="{{ $user }}" v-on:namesent="editValue"></prof-name>
            <div>
                <label class="label_prof wd80"><span>生年月日</span></label>
                <div>
                    <p>
                        {{ (int)$birthArr[0] }}年{{ (int)$birthArr[1] }}月{{ (int)$birthArr[2] }}日
                    </p>
                </div>          
            </div>
            <div>
                <label class="label_prof wd80"><span>性別</span></label>
                <div>
                    <p>
                        @if($user->sex == 'male')
                        男性
                        @else
                        女性
                        @endif
                    </p>
                </div>                                
            </div>
            <prof-region :region="{{ $region }}" :prefs="{{ $prefs }}" :user="{{ $user }}" v-on:regionsent="editValue"></prof-region>
<!--             <prof-idol :idols="{{ $idols }}" :idol_masters="{{ $idol_masters }}" :user="{{ $user }}"></prof-idol>
            <prof-activity :act_masters="{{ $act_masters }}" :user="{{ $user }}" :acts="{{ $activities }}"></prof-activity>      
            <prof-intro v-bind:user="{{ $user }}" v-on:introsent="editValue"></prof-intro>
            <prof-favorite :favorites="{{ $favorites }}" :user="{{ $user }}"></prof-favorite>       
            <prof-statue :statues="{{ $statues }}" :statue_masters="{{ $statue_masters }}" :user="{{ $user }}"></prof-statue>
            <prof-event :events="{{ $events }}" :user="{{ $user }}"></prof-event>
            <prof-email :user="{{ $user }}" v-on:emailsent="editValue"></prof-email> -->
        @else
            <form method="post" action="{{ url('/room') }}">
                {{ csrf_field() }}
                <input type="hidden" name="from_user_id" value="{{ Auth::id() }}">
                <input type="hidden" name="to_user_id" value="{{ $user->id }}">
                <input type="submit" name="" value="メッセージを送る">
            </form>
            <div>
                <h4 class="label_prof"><span>プロフィール画像</span></h4>
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
                    @foreach($idols as $idol)
                    <span class="tag_pink">{{ $idol->idol }}</span>
                    @endforeach
                </div>
            </div>
            <div>
                <h4 class="label_prof"><span>主な活動内容</span></h4>
                <div class="form-group">
                    @foreach($activity_names as $activity)
                    <span class="tag_grey">{{ $activity }}</span>
                    @endforeach
                </div>
            </div>
            <div>
                <h4 class="label_prof"><span>推し</span></h4>              
                <div class="form-group">
                    @foreach($favorites as $favorite)
                    <span class="tag_pink">{{ $favorite->favorite }}</span>
                    @endforeach
                </div>
            </div> 
            <div>
                <h4 class="label_prof"><span>活動場所</span></h4>
                <div>
                    @foreach($regions as $region)
                    <p class="tag_grey">{{ $region->region }}</p>
                    @endforeach
                </div>
            </div>
            <div>
                <h4 class="label_prof"><span>利用目的</span></h4>
                <div>
                    @foreach($purpose_masters as $purpose_master)
                    <ul>
                        <!-- true/falseで返すのはin_array(),キーを返すのはarray_search() -->
                        @if(in_array($purpose_master->id,$purpose_ids))
                        <li>{{ $purpose_master->purpose }}</li>
                        @endif
                    </ul>
                    @endforeach
                </div>
            </div>
            <div>
                <h4 class="label_prof"><span>繋がりたい人</span></h4>
                <div>                    
                    @foreach($statue_masters as $statue_master)
                    <p>
                        <!-- true/falseで返すのはin_array(),キーを返すのはarray_search() -->
                        @if(in_array($statue_master->id,$statue_ids))
                        <p>{{ $statue_master->statue }}</p>
                        @endif
                    </p>
                    @endforeach
                </div>
            </div>
            <div>
                <h4 class="label_prof"><span>参加予定イベント</span></h4>
                <div>
                    @foreach($events as $event)
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
        @endif
        </div>
    </div>
</div>
@endsection
