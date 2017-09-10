//プロフィール
Vue.component('prof-name',require('./components/ProfName.vue'));
Vue.component('prof-intro',require('./components/ProfIntroduction.vue'));
Vue.component('prof-idol',require('./components/ProfIdol.vue'));
Vue.component('prof-activity',require('./components/ProfActivity.vue'));
Vue.component('prof-region',require('./components/ProfRegion.vue'));
Vue.component('prof-favorite',require('./components/ProfFavorite.vue'));
Vue.component('prof-statue',require('./components/ProfStatue.vue'));
Vue.component('prof-event',require('./components/ProfEvent.vue'));
Vue.component('prof-email',require('./components/ProfEvent.vue'));

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
