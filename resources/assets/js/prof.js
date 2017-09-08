//プロフィール
Vue.component('prof-name',require('./components/ProfName.vue'));
Vue.component('prof-intro',require('./components/ProfIntroduction.vue'));
Vue.component('prof-idol',require('./components/ProfIdol.vue'));
Vue.component('prof-activity',require('./components/ProfActivity.vue'));

//Vueインスタンス生成
const prof = new Vue({
    el: '#prof',
	methods: {
		editValue(req){
			axios.patch('/users/' + req.id, req.request).then(res => {
				console.log(res.data);
			});
		}
	}
});
