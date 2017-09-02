<template lang="html">
	<div>
		<p class="chatMsg">{{ message.message }}</p>
		<div v-if="userId !== message.user.id">
			<img v-bind:src="message.user.img_path" class="thumb">
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
		background-color: #83d8fc;
		padding:10px;
		border-radius: 3px;
	}


</style>