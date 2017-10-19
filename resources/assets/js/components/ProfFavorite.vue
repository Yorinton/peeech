<template>
    <div class="mb20">
        <label class="label_prof wd80 mb15"><span>推し</span></label>
	    <div class="form-group disfle">
	        <input name="favorite" type="text" class="form-control inputBaseStyle mr10 fs16" v-model="favorite" placeholder="推し" required>
	        <button class="btn btn_add fs10" v-on:click="addFavorite">+</button>
	    </div>              
		<div class="wrap mt10 mb10">
		    <span v-for="favorite in favorite_names" class='tag_pink mr5 mb5' @click="removeFavorite(favorite)">× {{ favorite.favorite }}</span>
		</div>
    </div>
</template>
<script type="text/javascript">
	export default {
		props:["favorites","user"],
		data:function(){
			return {
				favorite:'',
				request:{
					favorite:''
				},
				favorite_names:this.favorites,
				remId:''
			}
		},
		methods:{
			addFavorite(){
				console.log(this.favorite);
				this.request.favorite = this.favorite;
				axios.post('/favorite/' + this.user.id,this.request).then(res => {
					console.log(res.data.favorite);
					this.favorite_names.push(res.data.favorite);
				}).catch(error => {
                    console.log('失敗><');
                    $(".msg_error").addClass('msg_appear_er');
                    setTimeout(function() {
                        $('.msg_error').removeClass('msg_appear_er');
                    }, 3000);
                });
			},
			removeFavorite(favorite){
				this.remId = this.favorite_names.indexOf(favorite);
				axios.delete('/users/' + favorite.id, {data:{key:'favorite'}}).then(res => {
					console.log(res.data);
					this.favorite_names.splice(this.remId,1);
				});
			}
		}
	}
</script>
<style type="text/css">
	
</style>