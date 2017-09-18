<template lang="html">
	<div class="msg_container">
		<p v-if="userId !== message.user.id" class="chatMsg msg_text_other">{{ message.message }}</p>
		<p v-else-if="userId === message.user.id" class="chatMsg msg_text_mine">{{ message.message }}</p>
		<div v-if="userId !== message.user.id" class="msg_thumb_container">
			<img v-bind:src="message.user.img_path" class="thumb msg_thumb">
		</div>
	</div>
</template>

<script>
	export default {
		props:["message","userId"]//ChatLog.vueからmesssageを受け取る
	}
</script>

<style lang="css">
	.chatMsg {
		padding:10px;
		border-radius: 3px;
		font-size: 12px;
	}
	.composer_container {
		width: 100%;
	    position: fixed;
	    bottom: 50px;
	    margin-left: -15px;
	    padding: 5px;
	    background-color: #eeeeee;
	}
	.msg_container {
		overflow: hidden;
	    width: 100%;
	}
	.msg_text_other {
		float: right;
	    width: 80%;
	    background-color: #f7f7f8;
	}
	.msg_text_mine {
		float: right;
	    width: 90%;
	    background-color: #ffe2db;
	}
	.msg_thumb_container {
		width: 15%;
	}
	.msg_thumb {
		width: 35px;
	    height: 35px;
	}

</style>