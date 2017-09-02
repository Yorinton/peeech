<template lang="html">
	<div class="chat-log">
		<chat-message v-for="message in messages" :key="message" v-bind:message="message" v-bind:user-id="userId"></chat-message>
		<div class="empty" v-show="messageLength === 0">
			まだメッセージはありません
		</div>
	</div>
</template>

<script>
	export default {
		props:["messages","userId"],
		computed: {
			messageLength: function(){
				return this.messages.length;
			}
		}
	}
</script>

<style lang="css">
	.empty {
		text-align: center;
		padding:1rem;
	}
</style>