<template>
    <div class="mb20">
        <label class="label_prof wd80 mb15"><span>居住地域</span></label>
        <div>
            <div class="disfle">
                <select name="region" type="text" class="form-control inputBaseStyle mr5" v-model="region.region">
                	<option disabled="disabled">選択して下さい</option>
                    <option v-for="pref in prefs" v-bind:value="pref">{{ pref }}</option>
                </select>
                <button class="btn btn_add fs10" v-on:click="sendRegion">+</button>
            </div>
        </div>
    </div>	
</template>
<script type="text/javascript">
	export default {
		props:{
			region:{type:Object,required:false},
			user:{name:Object,required:false},
			prefs:{name:Array,required:false}
		},
		data:function(){
			return {
				request:{
					region:''
				}
			}
		},
		methods:{
			sendRegion(){
				if(this.region.region){
					this.request.region = this.region.region;
					//namesentというイベントを送信
					this.$emit("regionsent",{
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