<template>
    <div class="form-group disfle">
        <input name="name" type="text" class="form-control inputBaseStyle mr10" v-model="name" placeholder="ニックネーム" required>
        <button class="form-control wd30 fs10" v-on:click="sendName">変更</button>
    </div>
</template>
<script>
	export default {
		props:["user"],//profile.blade.phpからuserを受け取る
		data: function(){
			return{
				name:this.user.name,
				request:{
					name:''
				}
			}
		},
		methods: {
			sendName(){
				if(this.name){
					this.request.name = this.name;
					//namesentというイベントを送信
					this.$emit("namesent",{
						id:this.user.id,
						request:this.request
					});
				}
			}
		}
	}
</script>

<style type="text/css">

</style>