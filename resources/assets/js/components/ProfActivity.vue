<template>
	<div>
		<label class="label_prof wd80"><span>主な活動内容 (タップで追加)</span></label>
		<div class="wrap">
		    <p v-for="act in act_masters">
		        <span v-if="addedActs.some(function(v){ return v.activity === act.activity })" class="selected_tag tag mr5 mb5" v-on:click="deleteAct(act)">{{ act.activity }}</span>
		        <span v-else class="tag mr5 mb5" v-on:click="addAct(act)">{{ act.activity }}</span>
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
				addedActs:this.acts
			}
		},
		methods:{
			addAct(act){
				console.log(act.activity);
			},
			deleteAct(act){
				console.log(act.activity);
				//
				this.addedActs.some(function(v,i,ar){
					if(v.activity === act.activity){
						console.log(i);
						ar.splice(i,1);
						console.log(ar);		
					}
				});
			}
		}
	}
</script>