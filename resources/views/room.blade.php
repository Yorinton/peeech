@extends('layouts.app')

@section('content')
<div class="container mb100 mt50">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
        	<div class="form-group">
        		<div id="app">
        		<div class="panel-heading">
                        <span class="badge pull-right">
                            @{{ usersInRoom.length }}
                        </span>         
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
	</div>
</div>
@endsection
