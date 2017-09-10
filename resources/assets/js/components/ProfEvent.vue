<template>
    <div>
        <label class="label_prof wd80"><span>参加予定イベント</span></label>
	    <div class="form-group disfle">
	        <input name="event" type="text" class="form-control inputBaseStyle mr10" v-model="event" placeholder="イベント名" required>
	        <button class="form-control wd30 fs10" v-on:click="addEvent">追加</button>
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
				axios.post('/users/' + this.user.id,this.request).then(res => {
					console.log(res.data.event);
					this.event_names.push(res.data.event);
				});
			},
			removeEvent(event){
				this.remId = this.event_names.indexOf(event);
				this.event_names.splice(this.remId,1);
				this.request.event = 'favorite';
				axios.delete('/users/' + event.id, {data:{key:'event'}}).then(res => {
					console.log(res.data);
				});
			}
		}
	}
</script>
<style type="text/css">
	
</style>