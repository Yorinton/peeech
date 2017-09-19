<template lang="html">
	<div class="chat-composer">
		<input id="message" type="text" name="" placeholder="メッセージを入力" v-model="messageText" @keyup.enter="sendMessage" required>
		<button class="ml5 btn inputBaseStyle submitBtn" @click="sendMessage">送信</button>
	</div>
</template>

<script>
	export default {
		data(){
			return{
				messageText:''
			}
		},
		methods: {
			sendMessage(){
				if(this.messageText){
					//$emitはイベントを発生させる(イベント名は'messagesent')
					this.$emit("messagesent",{
						// 3つのプロパティを持つオブジェクト？が送信される
						message: this.messageText,
						user: {
							name:$("#app-navbar-collapse > ul.nav.navbar-nav.navbar-right > li > a").text(),
							id:Number($(".user_id").text()),
							img_path:''
						},
						roomId: $(".room_id").text()
					});
					this.messageText = '';//input内を空に
				}
			}
		}
	}
</script>

<style lang="css">
	.chat-composer {
		display: flex;
	}
	.chat-composer input {
		flex: 1 auto;
	}
	.chat-composer button {
		border-radius: 0;
	}

</style>