<template>
	<div class="mb20">
		<label class="label_prof wd80 mb15"><span>主な活動内容 (タップで追加)</span></label>
		<div class="wrap">
		    <p v-for="act in act_masters">
		        <span v-if="addedActs.some(function(v){ return v.activity === act.activity })" class="tag_grey tag mr5 mb5" v-on:click="deleteAct(act)">{{ act.activity }}</span>
		        <span v-else class="tag_no_select mr5 mb5" v-on:click="addAct(act)">{{ act.activity }}</span>
		    </p>			    	    
		</div>               
	</div>	
</template>
<script>
	export default {
		props: ["act_masters","user","acts"],
		data:function(){
			return{
				remId:'',
				addedActs:this.acts,
				request:{
					activity:''
				}
			}
		},
		methods:{
			addAct(act){
				console.log(act.activity);
				this.addedActs.push(act);
				this.request.activity = act.activity;
				axios.post('/users/' + this.user.id, this.request).then(res => {
					console.log(res.data);
				});		
			},
			deleteAct(act){
				console.log(act.activity);
				//addedActs
				this.addedActs.some(function(v,i,ar){
					//addedActs = 登録済みactivityの配列
					//v には登録済みactivityのオブジェクトが入っている
					//i にはaddedActs内でのvのキーが入る
					if(v.activity === act.activity){
						ar.splice(i,1);
						axios.delete('/users/' + v.id, {data:{key:'activity'}}).then(res => {
							console.log(res.data);
						});									
					}				
				});
			}
		}
	}
</script>