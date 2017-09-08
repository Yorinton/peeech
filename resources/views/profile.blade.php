@extends('layouts.app')

@section('content')
<div class="container mb50 mt80 container_10">
    <div class="row" id="prof">
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
            <div>
                <label class="label_prof wd80"><span>ニックネーム</span></label>
                <prof-name v-bind:user="{{ $user }}" v-on:namesent="editValue"></prof-name>
            </div>      
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
            <div>
                <label class="label_prof wd80"><span>居住地域</span></label>
                <div>
                    <form class="form-group" method="post" action="{{ url('users/'.$user->id)}}">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        <div class="disfle">
                            <select name="region" type="text" class="form-control inputBaseStyle mr5" id="">
                                <option value="">選択して下さい</option>
                                @if(isset($region))
                                    @foreach($prefs as $pref)
                                        @if($pref == $region->region)
                                        <option value="{{ $pref }}" selected>{{ $pref }}</option>
                                        @else
                                        <option value="{{ $pref }}">{{ $pref }}</option>
                                        @endif
                                    @endforeach
                                @endif
                            </select>
                            <input class="form-control wd20" type="submit" value="変更">
                        </div>
                    </form>                   
                </div>
            </div>                         
            <prof-idol :idols="{{ $idols }}" :idol_masters="{{ $idol_masters }}" :user="{{ $user }}"></prof-idol>
 <!--            <div>
                <label class="label_prof wd80"><span>主な活動内容 (タップで追加)</span></label>
                <div class="wrap">
                    @foreach($act_masters as $act_master)
                    <p>
                        @if(in_array($act_master->activity,$activity_names))
                        <form class="form-group mr5" method="post" action="{{ url('users/'.$user->id)}}">
                            {{ csrf_field() }}
                            <input class="form-control selected_tag" type="submit" name="activity" value="{{ $act_master->activity }}">
                        </form>
                        @else
                        <form class="form-group mr5" method="post" action="{{ url('users/'.$user->id)}}">
                            {{ csrf_field() }}
                            <input class="form-control" type="submit" name="activity" value="{{ $act_master->activity }}">
                        </form>                        
                        @endif
                    </p>
                    @endforeach              
                </div>                
            </div> -->
            <prof-activity :act_masters="{{ $act_masters }}" :user="{{ $user }}" :acts="{{ $activities }}"></prof-activity>
            <div>
                <label class="label_prof wd80"><span>自己紹介</span></label>
                <prof-intro v-bind:user="{{ $user }}" v-on:introsent="editValue"></prof-intro>
            </div> 
            <div>
                <label class="label_prof wd80"><span>推し</span></label>
                <form class="form-group" method="post" action="{{ url('users/'.$user->id)}}">
                    {{ csrf_field() }}
                    <div class="disfle">
                        <input name="favorite" type="text" class="form-control form-favorite inputBaseStyle mr5" placeholder="推しの名前を記入" id="">
                        <input class="form-control wd20" type="submit" value="追加">
                    </div>
                </form>                
                <div>
                    @if($favorites)
                    @foreach($favorites as $favorite)
                    <span class='added_favorite'>
                        <form class="form-group" method="post" action="{{ url('users/'.$user->id.'/'.$favorite->id)}}">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <input type="hidden" name="favorite" value="favorite">
                            <input type="submit" value="×">
                            <span>{{ $favorite->favorite }}</span>
                        </form>
                    </span>
                    @endforeach
                    @endif
                </div>
            </div>          
<!--             <div>
                <h4 class="label_prof"><span>利用目的</span></h4>
                <div>
                    <form class="form-group" method="post" action="{{ url('users/'.$user->id)}}">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }} 
                        @foreach($purpose_masters as $purpose_master)
                        <p>
                            @if(in_array($purpose_master->id,$purpose_ids))
                            <input type="checkbox" name="purpose[]" value="{{$purpose_master->id}}" checked="checked">{{ $purpose_master->purpose }}
                            @else
                            <input type="checkbox" name="purpose[]" value="{{$purpose_master->id}}">{{ $purpose_master->purpose }}
                            @endif
                        </p>
                        @endforeach
                        <input class="form-control" type="submit" value="変更"> 
                    </form>
                </div>
            </div>
 -->            <div>
                <label class="label_prof wd80"><span>こんな人と繋がりたい</span></label>
                <div>
                    <form class="form-group" method="post" action="{{ url('users/'.$user->id)}}">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}                    
                        @foreach($statue_masters as $statue_master)
                        <p>
                            @if(in_array($statue_master->id,$statue_ids))
                            <input type="checkbox" name="statue[]" value="{{$statue_master->id}}" checked="checked">{{ $statue_master->statue }}
                            @else
                            <input type="checkbox" name="statue[]" value="{{$statue_master->id}}">{{ $statue_master->statue }}
                            @endif
                        </p>
                        @endforeach
                        <input class="form-control" type="submit" value="変更"> 
                    </form>
                </div>
            </div>
            <div>
                <label class="label_prof wd80"><span>参加予定イベント</span></label>
                <form class="form-group" method="post" action="{{ url('users/'.$user->id)}}">
                    {{ csrf_field() }} 
                    <input name="event" type="text" class="form-control form-idol" placeholder="" id="" required>
                    <input class="form-control" type="submit" value="追加"> 
                </form>
                <div>
                    @foreach($events as $event)
                    <span class='added_event'>
                        <form class="form-group" method="post" action="{{ url('users/'.$user->id.'/'.$event->id)}}">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <input type="hidden" name="event" value="event">
                            <input type="submit" value="×">
                            <span>{{ $event->event }}</span>
                        </form>
                    </span>
                    @endforeach
                </div>
            </div>
            <div>
                <label class="label_prof wd80"><span>メールアドレス(非公開)</span></label>
                <form class="form-group" method="post" action="{{ url('/users/'.$user->id)}}">
                    {{ csrf_field() }}                
                    {{ method_field('PATCH') }}                                
                    <input name="email" type="email" class="form-control" placeholder="メールアドレス" id="" value="{{ decrypt($user->email) }}" required>
                    <input class="form-control" type="submit" value="変更">                   
                </form>                
            </div> 
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
 <!--            <div>
                <h4 class="label_prof"><span>メールアドレス</span></h4>
                <div class="form-group">                            
                    <p>{{ decrypt($user->email) }}</p>
                </div>          
            </div>      -->       
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
