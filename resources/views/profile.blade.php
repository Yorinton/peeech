@extends('layouts.app')

@section('content')
    <div class="container mb50 mt80 container_10">
        <div class="row" id="prof">
            <msg></msg>
            <msg-error></msg-error>
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
                        <div class="thumb_container mb20 wrap">
                            <img class="thumb preview" src="{{ $user->img_path }}">
                            <form class="form-group thumb_form ml10" method="post"
                                  action="{{ url('/user',$user->id,$is_production) }}" enctype="multipart/form-data"
                                  files='true'>
                                {{ csrf_field() }}
                                {{ method_field('PATCH') }}
                                <div class="wrap mb0 lh80 dis_inblo">
                                    <label for="file" class="btn inputBaseStyle">画像を設定</label>
                                    <input id="file" type="file" name="img_path" style="display:none;">
                                    <input class="btn inputBaseStyle submitBtn" type="submit" value="変更">
                                </div>
                            </form>
                        </div>
                    </div>
                    <prof-name v-bind:user="{{ $user }}" v-on:namesent="editValue"></prof-name>
                    <div class="mb20">
                        <label class="label_prof wd80 mb10"><span>年齢 / 性別</span></label>
                        <div class="ml10 fs16">
                            <span>{{ $user->birthday }} / </span>
                            <span>{{ $user->sex }}</span>
                        </div>
                    </div>
                    <prof-region :region="{{ $region }}" :prefs="{{ $prefs }}" :user="{{ $user }}"
                                 v-on:regionsent="editValue"></prof-region>
                    <prof-idol :idols="{{ $user->idols }}" :idol_masters="{{ $idol_masters }}"
                               :user="{{ $user }}"></prof-idol>
                    <prof-activity :act_masters="{{ $act_masters }}" :user="{{ $user }}"
                                   :acts="{{ $user->activities }}"></prof-activity>
                    <prof-intro v-bind:user="{{ $user }}" v-on:introsent="editValue"></prof-intro>
                    <prof-favorite :favorites="{{ $user->favorites }}" :user="{{ $user }}"></prof-favorite>
                    <prof-statue :statues="{{ $user->statues }}" :statue_masters="{{ $statue_masters }}"
                                 :user="{{ $user }}"></prof-statue>
                    <prof-event :events="{{ $user->events }}" :user="{{ $user }}"></prof-event>
                    <prof-email :user="{{ $user }}" v-on:emailsent="editValue"></prof-email>
                    <div>
                        <ul class="pl0">
                            <li class="btn_logout_list">
                                {{--<a class="btn_logout" href=""--}}
                                {{--onclick="event.preventDefault();--}}
                                {{--document.getElementById('logout-form').submit();">--}}
                                {{--ログアウト--}}
                                {{--</a>--}}

                                <form id="logout-form" action="{{ url('/logout',[],$is_production) }}" method="POST">
                                    {{ csrf_field() }}
                                    <input type="submit" name="" value="ログアウト">
                                </form>
                            </li>
                        </ul>
                    </div>
                    <div id="slider-pro" class="slider-pro {{ $tutorial }}">
                        <div class="sp-slides">
                            <div class="sp-slide"><img class="sp-image"
                                                       src="{{ asset('images/services/tutorial/tutorial1.png',$is_production) }}">
                            </div>
                            <div class="sp-slide"><img class="sp-image"
                                                       src="{{ asset('images/services/tutorial/tutorial2.png',$is_production) }}">
                            </div>
                            <div class="sp-slide"><img class="sp-image"
                                                       src="{{ asset('images/services/tutorial/tutorial3.png',$is_production) }}">
                            </div>
                            <div class="sp-slide">
                                <img class="sp-image"
                                     src="{{ asset('images/services/tutorial/tutorial4-2.png',$is_production) }}">
                                <img class="sp-image btn_close"
                                     src="{{ asset('images/services/tutorial/btn.png',$is_production) }}">
                            </div>
                        </div>
                    </div>
                @else
                    <p>ご指定のユーザーのプロフィールは表示出来ません</p>
                @endif
            </div>
        </div>
    </div>
@endsection
