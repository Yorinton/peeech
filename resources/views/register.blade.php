@extends('layouts.app')

@section('content')
<div class="container mb50 mt80 container_10">
    <div class="row">
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
            <form method="POST" action="{{ url('/profiles/'.$user->id) }}">
                {{ csrf_field() }}
                <div class="form-group mb20">
                    <label for="" class="label_prof wd80"><span>ニックネーム</span></label><span class="required">必須</span>
                    <input name="name" value="{{ old('name',$user->name) }}" type="text" class="form-control inputBaseStyle mt10" placeholder="ニックネーム" id="" required>
                </div>
                <div class="form-group mb20">
                    <label for="" class="label_prof wd80"><span>メールアドレス</span></label><span class="required">必須</span>
                    @if(isset($user->email))
                    <input name="email" value="{{ old('email',decrypt($user->email)) }}" type="email" class="form-control inputBaseStyle mt10" placeholder="メールアドレス" id="" required>
                    @else
                    <input name="email" value="{{ old('email') }}" type="email" class="form-control inputBaseStyle mt10" placeholder="メールアドレス" id="" required>
                    @endif
                </div>
                <div class="form-group mb20">
                    <label for="" class="label_prof wd80"><span>生年月日</span></label><span class="required">必須</span>
                    <div class="sp-between mt10">
                        <select name="year" class="form-control inputBaseStyle mr20 he30 fs12">
                            <option>年</option>
                            @for($i=2002;$i > 1949;$i--)
                                @if(isset($birthArr) and (int)$birthArr[0] === $i)
                                <option selected>{{ $i }}</option>
                                @else
                                <option>{{ $i }}</option>
                                @endif
                            @endfor
                        </select>
                        <select name="month" class="form-control inputBaseStyle mr20 he30 fs12">
                            <option>月</option>
                            @for($i=1;$i < 13;$i++)
                                @if(isset($birthArr) and (int)$birthArr[0] === $i)
                                <option selected>{{ $i }}</option>
                                @else
                                <option>{{ $i }}</option>
                                @endif
                            @endfor
                        </select>
                        <select name="day" class="form-control inputBaseStyle he30 fs12">
                            <option>日</option>
                            @for($i=1;$i < 32;$i++)
                                @if(isset($birthArr) and (int)$birthArr[2] === $i)
                                <option selected>{{ $i }}</option>
                                @else
                                <option>{{ $i }}</option>
                                @endif
                            @endfor
                        </select>
                    </div>                     
                </div> 
                <div class="form-group mb20">
                    <label for="" class="label_prof wd80"><span>性別</span></label><span class="required">必須</span>
                    <div class="form-group mt10">
                        <input type="radio" name="sex" value="male" id="male" class="disnone">
                        <label class="sex_label tag_no_select" for="male">男性</label>
                        <input type="radio" name="sex" value="female" id="female" class="disnone">
                        <label class="sex_label tag_no_select" for="female">女性</label>
                    </div>
                  <!--   <select name="sex" class="form-control" id="" required>
                        <option value="male">男</option>
                        <option value="female">女</option>
                    </select> -->
                </div>                                               
                <div class="form-group mb20">
                    <label for="" class="label_prof wd80"><span>好きなアイドル</span></label><span class="required">必須</span>
                    <div class="disfle mt10">
                        <select name='phonetic' class="form-control phonetic inputBaseStyle mr5 wd35">
                            <option value="1">あ行</option>
                            <option value="2">か行</option>
                            <option value="3">さ行</option>
                            <option value="4">た行</option>
                            <option value="5">な行</option>
                            <option value="6">は行</option>
                            <option value="7">ま行</option>
                            <option value="8">や行</option>
                            <option value="9">ら行</option>
                            <option value="10">わ行</option>
                        </select>
                        <div class="wd65">
                            <select name="idol" class="form-control form-idol disblo inputBaseStyle mr5" id="idols_1">
                                @foreach($idol_masters->where('phonetic_id','>=',1)->where('phonetic_id','<=',5) as $idol)
                                <option>{{ $idol->idol }}</option>
                                @endforeach
                            </select>
                            <select name="idol" class="form-control form-idol disnone inputBaseStyle mr5" id="idols_2">
                                @foreach($idol_masters->where('phonetic_id','>=',6)->where('phonetic_id','<=',10) as $idol)
                                <option>{{ $idol->idol }}</option>
                                @endforeach
                            </select>
                            <select name="idol" class="form-control form-idol disnone inputBaseStyle mr5" id="idols_3">
                                @foreach($idol_masters->where('phonetic_id','>=',11)->where('phonetic_id','<=',15) as $idol)
                                <option>{{ $idol->idol }}</option>
                                @endforeach
                            </select>
                            <select name="idol" class="form-control form-idol disnone inputBaseStyle mr5" id="idols_4">
                                @foreach($idol_masters->where('phonetic_id','>=',16)->where('phonetic_id','<=',20) as $idol)
                                <option>{{ $idol->idol }}</option>
                                @endforeach
                            </select>
                            <select name="idol" class="form-control form-idol disnone inputBaseStyle mr5" id="idols_5">
                                @foreach($idol_masters->where('phonetic_id','>=',21)->where('phonetic_id','<=',25) as $idol)
                                <option>{{ $idol->idol }}</option>
                                @endforeach
                            </select>
                            <select name="idol" class="form-control form-idol disnone inputBaseStyle mr5" id="idols_6">
                                @foreach($idol_masters->where('phonetic_id','>=',26)->where('phonetic_id','<=',30) as $idol)
                                <option>{{ $idol->idol }}</option>
                                @endforeach
                            </select>
                            <select name="idol" class="form-control form-idol disnone inputBaseStyle mr5" id="idols_7">
                                @foreach($idol_masters->where('phonetic_id','>=',31)->where('phonetic_id','<=',35) as $idol)
                                <option>{{ $idol->idol }}</option>
                                @endforeach
                            </select>                                                                                      
                            <select name="idol" class="form-control form-idol disnone inputBaseStyle mr5" id="idols_8">
                                @foreach($idol_masters->where('phonetic_id','>=',36)->where('phonetic_id','<=',40) as $idol)
                                <option>{{ $idol->idol }}</option>
                                @endforeach
                            </select> 
                            <select name="idol" class="form-control form-idol disnone inputBaseStyle mr5" id="idols_9">
                                @foreach($idol_masters->where('phonetic_id','>=',41)->where('phonetic_id','<=',45) as $idol)
                                <option>{{ $idol->idol }}</option>
                                @endforeach
                            </select>
                            <select name="idol" class="form-control form-idol disnone inputBaseStyle mr5" id="idols_10">
                                @foreach($idol_masters->where('phonetic_id',46) as $idol)
                                <option>{{ $idol->idol }}</option>
                                @endforeach
                            </select>
                        </div>
                        <p>
                            <a class="btn btn-idol ml5 btn_add"> + </a>
                        </p>
                    </div>                                       
                    <div class="wrap">
                        <span class="del_idol"></span>
                    </div>                   
                </div>
<!--                 <div class="form-group">
                    <label for="" class="label_prof">推し</label>
                    <input name="favorite" type="text" class="form-control form-favorite" placeholder="" id="">
                    <p>
                        <a class="btn btn-success btn-favorite"> + </a>
                    </p>
                    <div>
                        <span class="del_favorite"></span>
                    </div>
                </div> -->
                <div class="form-group mb20">
                    <label for="" class="label_prof wd80"><span>居住地域</span></label><span class="required">必須</span>
                    <select name="region[]" type="text" class="form-control inputBaseStyle mt10" id="">
                        <option value="">選択してね</option>
                        @foreach($prefs as $pref)
                        <option value="{{ $pref }}">{{ $pref }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb20">
                    <label for="" class="label_prof wd80"><span>利用目的</span></label><span class="required">必須</span>
                    <div class="form-group mt10">
                    @if(isset($purpose_masters))
                        @foreach($purpose_masters as $purpose_master)
                            <div class="checkbox_container mb10">
                                <label for="{{ $purpose_master->id}}" class="fs10 checkbox_{{ $purpose_master->id}}">
                                <img class="thumb_mini_s img_checkbox_{{ $purpose_master->id}} mr5" src="../../images/icons/no_checked.png">{{ $purpose_master->purpose }}</label>
                                <input id="{{ $purpose_master->id}}" type="checkbox" name="purpose[]" value="{{ $purpose_master->id}}" class="{{ $purpose_master->id}} disnone">
                            </div>
                        @endforeach
                    @endif 
                    </div>                 
                </div>
<!--                 <div class="form-group">
                    <label for="" class="label_prof">どんな人と繋がりたい？</label>
                    <p>
                        <input type="checkbox" name="statue[]" value="1" checked="checked">statue1
                    </p>
                    <p>
                        <input type="checkbox" name="statue[]" value="2" checked="checked">statue2
                    </p>
                    <p>
                        <input type="checkbox" name="statue[]" value="3" checked="checked">statue3
                    </p>
                </div> -->
<!--                 <div class="form-group">
                    <label for="" class="label_prof">参加予定イベント</label>
                    <input name="event" type="text" class="form-control form-event" placeholder="参加予定イベント" id="">
                    <p>
                        <a class="btn btn-success btn-event"> + </a>
                    </p>
                    <div>
                        <span class="del_event"></span>
                    </div>
                </div> -->
<!--                 <div class="form-group">
                    <label for="" class="label_prof">自己紹介</label>
                    <textarea name="introduction" class="form-control" placeholder="自己紹介" id="" rows="20" required>{{ old('introduction',$user->introduction) }}</textarea>
                </div> -->
                <div class="form-group submitBtnContainer">
                    <input class="form-control registerBtn" type="submit" value="登録">
                </div>           
            </form>
        </div>
    </div>
</div>
@endsection
