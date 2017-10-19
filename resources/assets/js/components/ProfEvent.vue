<template>
    <div class="mb20">
        <label class="label_prof wd80 mb15"><span>参加予定イベント</span></label>
	    <div class="form-group disfle">
	        <input name="event" type="text" class="form-control inputBaseStyle mr10 fs16" v-model="event" placeholder="イベント名" required>
	        <button class="btn btn_add fs10" v-on:click="addEvent">+</button>
	    </div>              
		<div class="wrap mt10 mb10">
		    <span v-for="event in event_names" class='tag_pink mr5 mb5' @click="removeEvent(event)">× {{ event.event }}</span>
		</div>
    </div>
</template>
<script type="text/javascript">
	export default {
		props:["events","user"],
		data:function(){
			return {
				event:'',
				request:{
					event:''
				},
				event_names:this.events,
				remId:''
			}
		},
		methods:{
			addEvent(){
				console.log(this.event);
				this.request.event = this.event;
				axios.post('/event/' + this.user.id,this.request).then(res => {
					console.log(res.data.event);
					this.event_names.push(res.data.event);
				}).catch(error => {
                    console.log('失敗><');
                    $(".msg_error").addClass('msg_appear_er');
                    setTimeout(function() {
                        $('.msg_error').removeClass('msg_appear_er');
                    }, 3000);
                });
			},
			removeEvent(event){
				this.remId = this.event_names.indexOf(event);
				axios.delete('/users/' + event.id, {data:{key:'event'}}).then(res => {
					console.log(res.data);
					this.event_names.splice(this.remId,1);
				});
			}
		}
	}
</script>
<style type="text/css">
	
</style>