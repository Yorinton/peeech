<template>
	<div class="mb20">
		<label class="label_prof wd80 mb15"><span>自己紹介</span></label>
	    <div class="form-group">
	        <textarea name="introduction" class="form-control inputBaseStyle mr10 fs16" v-model="introduction" placeholder="自己紹介" rows="7" required></textarea>
	        <button class="form-control wd100 fs14 mt10 btn inputBaseStyle submitBtn" v-on:click="sendIntroduction">登録</button>
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