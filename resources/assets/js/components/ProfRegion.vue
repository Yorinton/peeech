<template>
    <div>
        <label class="label_prof wd80"><span>居住地域</span></label>
        <div>
            <div class="disfle">
                <select name="region" type="text" class="form-control inputBaseStyle mr5" v-model="selected">
                	<option disabled="disabled">選択して下さい</option>
                    <option v-for="pref in prefs" v-bind:value="pref">{{ pref }}</option>
                </select>
                <button class="form-control wd20" v-on:click="sendRegion">変更</button>
            </div>
        </div>
    </div>	
</template>
<script type="text/javascript">
	export default {
		props:["region","prefs","user"],
		data:function(){
			return {
				selected:this.region.region,
				request:{
					region:''
				}
			}
		},
		methods:{
			sendRegion(){
				if(this.selected){
					this.request.region = this.selected;
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