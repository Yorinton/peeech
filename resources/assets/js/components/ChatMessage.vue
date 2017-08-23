<template lang="html">
	<div>
		<p>{{ message.message }}</p>
		<small>{{ message.user.name }}</small>
	</div>
</template>

<script>
	export default {
		props:["message"]//ChatLog.vueからmesssageを受け取る
	}
</script>

<style lang="css">
	
</style>