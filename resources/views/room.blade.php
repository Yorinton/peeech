@extends('layouts.app')

@section('content')
<div class="container mb30 mt50">
    <div class="row">
        <div class="content_left_top">
            <p class="mb0"><a class="{{ $backUrl['class'] }} fc_white" href="{{ $backUrl['url'] }}">戻る</a></p>
        </div>
        @if(isset($m))
        <span class="msg_error">{{ $m }}</span>
        @endif
        @if(isset($friend))
        <div class="content_right_top">   
            <a href="{{ url('/friend',[Auth::id(),$friend->id],$is_production) }}">
                <img class="menu_btn_img" src="{{ asset('images/icons/profile.png',$is_production) }}">
            </a>
        </div>       
        <div class="col-md-8 col-md-offset-2">
        	<div class="form-group">
        		<div id="app">
        		    <div class="panel-heading">
                    </div>
        			<chat-log v-bind:messages="messages" v-bind:user-id="{{ $user->id }}"></chat-log>
                    <div class="composer_container">
                        <chat-composer v-on:messagesent="addMessage"></chat-composer>
                    </div>
                   	<div class="room_id disnone">{{ $room_id }}</div>
                    <div class="user_id disnone">{{ $user->id }}</div>
        		</div>
			</div>
		</div>
        @endif 
	</div>
</div>
@endsection
