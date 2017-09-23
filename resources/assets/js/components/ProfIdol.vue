<template>
	<div class="mb20">
		<label class="label_prof wd80 mb15"><span>好きなアイドル</span></label>
	    <div class="disfle">
	        <select name='phonetic' class="form-control phonetic inputBaseStyle mr5 wd35 fs16" v-on:change="selectPhonetic" v-model="selected">
	        	<option v-for="phonetic in phonetics" v-bind:value="phonetic.value">{{ phonetic.text }}</option>
	        </select>
	        <div class="wd65 mr5">
	            <select name="idol" class="form-control form-idol disblo inputBaseStyle mr5 fs16" id="idols_1">
	                <option v-for="idol in idol_masters" v-if="idol.phonetic_id >= 1 && idol.phonetic_id <= 5">{{ idol.idol }}</option>
	            </select>
	            <select name="" class="form-control form-idol disnone inputBaseStyle mr5 fs16" id="idols_2">
	                <option v-for="idol in idol_masters" v-if="idol.phonetic_id >= 6 && idol.phonetic_id <= 10">{{ idol.idol }}</option>
	            </select>
	            <select name="" class="form-control form-idol disnone inputBaseStyle mr5 fs16" id="idols_3">
	                <option v-for="idol in idol_masters" v-if="idol.phonetic_id >= 11 && idol.phonetic_id <= 15">{{ idol.idol }}</option>
	            </select>
	            <select name="" class="form-control form-idol disnone inputBaseStyle mr5 fs16" id="idols_4">
	                <option v-for="idol in idol_masters" v-if="idol.phonetic_id >= 16 && idol.phonetic_id <= 20">{{ idol.idol }}</option>
	            </select>
	            <select name="" class="form-control form-idol disnone inputBaseStyle mr5 fs16" id="idols_5">
	                <option v-for="idol in idol_masters" v-if="idol.phonetic_id >= 21 && idol.phonetic_id <= 25">{{ idol.idol }}</option>
	            </select>
	            <select name="" class="form-control form-idol disnone inputBaseStyle mr5 fs16" id="idols_6">
	                <option v-for="idol in idol_masters" v-if="idol.phonetic_id >= 26 && idol.phonetic_id <= 30">{{ idol.idol }}</option>
	            </select>
	            <select name="" class="form-control form-idol disnone inputBaseStyle mr5 fs16" id="idols_7">
	                <option v-for="idol in idol_masters" v-if="idol.phonetic_id >= 31 && idol.phonetic_id <= 35">{{ idol.idol }}</option>
	            </select>
	            <select name="" class="form-control form-idol disnone inputBaseStyle mr5 fs16" id="idols_8">
	                <option v-for="idol in idol_masters" v-if="idol.phonetic_id >= 36 && idol.phonetic_id <= 40">{{ idol.idol }}</option>
	            </select> 
	            <select name="" class="form-control form-idol disnone inputBaseStyle mr5 fs16" id="idols_9">
	                <option v-for="idol in idol_masters" v-if="idol.phonetic_id >= 41 && idol.phonetic_id <= 45">{{ idol.idol }}</option>
	            </select>
	            <select name="" class="form-control form-idol disnone inputBaseStyle mr5 fs16" id="idols_10">
	                <option v-for="idol in idol_masters" v-if="idol.phonetic_id === 46">{{ idol.idol }}</option>
	            </select>
	        </div>                  
	        <button class="btn btn-idol ml5 btn_add" v-on:click="addIdol">+</button> 
	    </div>
		<div class="wrap mt10 mb10">
		    <span v-for="idol in idol_names" class='added_idol tag_pink mr5 mb5' @click="removeIdol(idol)">× {{ idol.idol }}</span>
		</div>
	</div>
</template>
<script>
	export default {
		props:["idols","idol_masters","user"],
		data:function(){
			return {
				selected: 1,//セレクトボックスの初期値のvalueを指定
				phonetics: [
					{ text:'あ行',value:1},
					{ text:'か行',value:2},
					{ text:'さ行',value:3},
					{ text:'た行',value:4},
					{ text:'な行',value:5},
					{ text:'は行',value:6},
					{ text:'ま行',value:7},
					{ text:'や行',value:8},
					{ text:'ら行',value:9},
					{ text:'わ行',value:10}
				],
				num:'',
				request:{
					idol:''
				},
				idol_names:this.idols,
				remId:''
			}
		},
		methods:{
			addIdol(){
				this.request.idol = $("select[name='idol'] > option:selected").text();
				console.log(this.request.idol);
				axios.post('/idol/' + this.user.id,this.request).then(res => {
					console.log(res.data);
					this.idol_names.push(res.data.idol);//res.data = ['idol' => request('idol')]
				});
			},
			removeIdol(idol){
				this.remId = this.idol_names.indexOf(idol);
				this.idol_names.splice(this.remId,1);
				axios.delete('/users/' + idol.id, {data:{key:'idol'}}).then(res => {
					console.log('成功');
				});
			},
			selectPhonetic(){
				this.num = this.selected;
				$('.disblo').addClass('disnone').attr('name','').removeClass('disblo');
				$("#idols_" + this.num).addClass('disblo').removeClass('disnone').attr('name','idol');
			}
		}
	}
</script>


