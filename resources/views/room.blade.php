@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
        	<div class="form-group">メッセージを送る
        		<div id="app">
        		<div class="panel-heading">
                        chatroom
                        <span class="badge pull-right">
                            @{{ usersInRoom.length }}
                        </span>         
                    	</div>
        			<chat-log v-bind:messages="messages"></chat-log>
        			<chat-composer v-on:messagesent="addMessage"></chat-composer>
                   	<div class="room_id" style="display:none;">{{ $room_id }}</div>
        		</div>
                <?php echo $_SERVER['SERVER_PORT'];?>
        		@if(isset($friend))
        		<h4>{{ $friend->name }}</h4>
				<input class="form-control message" type="text" name="message">
				<button class="submit">送信</button>
				@elseif(isset($m))
				<p>{{ $m }}</p>
				@endif
			</div>
		</div>
	</div>
</div>
@endsection
