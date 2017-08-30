<template lang="html">
	<div>
		<p class="chatMsg">{{ message.message }}</p>
		<small>{{ message.user.name }}</small>
	</div>
</template>

<script>
	export default {
		props:["message"]//ChatLog.vueからmesssageを受け取る
	}
</script>

<style lang="css">
	.chatMsg {
		background-color: #83d8fc;
		padding:10px;
		border-radius: 3px;
	}


</style>