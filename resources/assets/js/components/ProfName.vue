<template>
	<div class="mb20">
		<label class="label_prof wd80 mb15"><span>ニックネーム</span></label>
	    <div class="form-group disfle">
	        <input name="name" type="text" class="form-control inputBaseStyle mr10" v-model="name" placeholder="ニックネーム" required>
	        <button class="btn fs10 btn_add" v-on:click="sendName">+</button>
	    </div>
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