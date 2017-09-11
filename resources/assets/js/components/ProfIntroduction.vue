<template>
	<div>
		<label class="label_prof wd80"><span>自己紹介</span></label>
	    <div class="form-group">
	        <textarea name="introduction" class="form-control inputBaseStyle mr10" v-model="introduction" placeholder="自己紹介" rows="5" required></textarea>
	        <button class="form-control wd30 fs10" v-on:click="sendIntroduction">変更</button>
	    </div>
	</div>
</template>
<script>
	export default {
		props:["user"],//profile.blade.phpからuserを受け取る
		data: function(){
			return{
				introduction:this.user.introduction,
				request:{
					introduction:''
				}
			}
		},
		methods: {
			sendIntroduction(){
				if(this.introduction){
					this.request.introduction = this.introduction;
					//namesentというイベントを送信
					this.$emit("introsent",{
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