<template>
	<div class="mb20">
	    <label class="label_prof wd80 mb15"><span>こんな人と繋がりたい</span></label>
	    <div class="wrap">                   
            <p v-for="statue in statue_masters">
                <span v-if="addedStatues.some(function(v){ return v.statue_id === statue.id })" class="tag_grey tag mr5 mb5" @click="deleteStatue(statue)">{{ statue.statue }}</span>
				<span v-else class="tag_no_select mr5 mb5" @click="addStatue(statue)">{{ statue.statue }}</span>
            </p>
	    </div>
	</div>
</template>
<script>
	export default {
		props: ["statue_masters","user","statues"],
		data:function(){
			return{
				remId:'',
				addedStatues:this.statues,
				request:{
					statue_id:''
				}
			}
		},
		methods:{
			addStatue(statue){
				this.addedStatues.push(statue);
				this.request.statue_id = statue.id;
				axios.post('/statue/' + this.user.id, this.request).then(res => {
					console.log(res.data.statue.id);
					this.addedStatues.push(res.data.statue);
				});		
			},
			deleteStatue(statue){
				this.addedStatues.some(function(v,i,ar){
					if(v.statue_id === statue.id){
						ar.splice(i,1);
						axios.delete('/users/' + v.id, {data:{key:'statue'}}).then(res => {
							console.log(res.data);
						});									
					}				
				});
			}
		}
	}
</script>