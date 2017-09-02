@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
        	<div class="form-group">メッセージを送る
        		<div id="app">
        		<div class="panel-heading">
                        <span class="badge pull-right">
                            @{{ usersInRoom.length }}
                        </span>         
                    	</div>
        			<chat-log v-bind:messages="messages"></chat-log>
        			<chat-composer v-on:messagesent="addMessage"></chat-composer>
                   	<div class="room_id" style="display:none;">{{ $room_id }}</div>
        		</div>
			</div>
		</div>
	</div>
</div>
@endsection
