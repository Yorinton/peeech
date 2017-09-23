<template>
	<div class="mb20">
		<label class="label_prof wd80 mb15"><span>メールアドレス(非公開)</span></label>
	    <div class="form-group disfle">
	        <input name="email" type="email" class="form-control inputBaseStyle mr10 fs16" v-model="email" placeholder="sample@example.com" required>
	        <button class="btn btn_add fs10" v-on:click="sendEmail">+</button>
	    </div>
	</div>    
</template>
<script>
	export default {
		props:["user"],//profile.blade.phpからuserを受け取る
		data: function(){
			return{
				email:this.user.email,
				request:{
					email:''
				}
			}
		},
		methods: {
			sendEmail(){
				if(this.email){
					this.request.email = this.email;
					//namesentというイベントを送信
					this.$emit("emailsent",{
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