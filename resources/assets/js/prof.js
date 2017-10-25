//プロフィール
Vue.component('prof-name',require('./components/ProfName.vue'));
Vue.component('prof-intro',require('./components/ProfIntroduction.vue'));
Vue.component('prof-idol',require('./components/ProfIdol.vue'));
Vue.component('prof-activity',require('./components/ProfActivity.vue'));
Vue.component('prof-region',require('./components/ProfRegion.vue'));
Vue.component('prof-favorite',require('./components/ProfFavorite.vue'));
Vue.component('prof-statue',require('./components/ProfStatue.vue'));
Vue.component('prof-event',require('./components/ProfEvent.vue'));
Vue.component('prof-email',require('./components/ProfEmail.vue'));
Vue.component('msg',require('./components/common/Msg.vue'));
Vue.component('msg-error',require('./components/common/MsgError.vue'));

//Vueインスタンス生成
const prof = new Vue({
    el: '#prof',
	methods: {
		editValue(req){
			if(!req.request.region){
				axios.patch('/user/' + req.id, req.request).then(res => {
					if(res.data){
						$(".msg_cover").addClass('msg_appear');
						setTimeout(function() {
		    				$('.msg_cover').removeClass('msg_appear');
						}, 3000);
					}
				}).catch(error => {
                    $(".msg_error_prof").addClass('msg_appear_er');
                    setTimeout(function() {
                        $('.msg_error_prof').removeClass('msg_appear_er');
                    }, 3000);
				});
			}else{
				axios.patch('/region/' + req.id, req.request).then(res => {
					if(res.data){
						$(".msg_cover").addClass('msg_appear');
						setTimeout(function() {
		    				$('.msg_cover').removeClass('msg_appear');
						}, 3000);
					}
				}).catch(error => {
                    $(".msg_error_prof").addClass('msg_appear_er');
                    setTimeout(function() {
                        $('.msg_error_prof').removeClass('msg_appear_er');
                    }, 3000);
				});
			}
		}
	},
});
