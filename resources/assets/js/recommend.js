
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

Vue.component('reco-list', require('./components/RecommendLists.vue'));

//Vueインスタンス生成
const recommend = new Vue({
	el:'#reco',
	
});