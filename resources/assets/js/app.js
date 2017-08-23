
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example', require('./components/Example.vue'));
Vue.component('chat-message', require('./components/ChatMessage.vue'));
Vue.component('chat-log', require('./components/ChatLog.vue'));
Vue.component('chat-composer', require('./components/ChatComposer.vue'));

//Vueインスタンス生成
const app = new Vue({
    el: '#app',
    data: {
		messages: [],
        usersInRoom: []
    },
    methods: {
    	addMessage(message){
    		//Add to existing messages
    		this.messages.push(message);//push() -> 配列の末尾に要素を追加
    		//Persist to the database etc
    		//このメソッドが呼び出された際に、指定のURLに非同期でポストする
            axios.post('/messages', message).then(response => {
            	console.log(response.data);
            });
    	}
    },
    created(){
        var roomId = $(".room_id").text();

    	//このインスタンスが作成された際に、指定のURLに非同期でリクエストする
    	axios.get('/messages/' + roomId).then(response => {
    		this.messages = response.data;
    		// console.log(response);
    	});
        Echo.join('chatroom.' + roomId)// 入室しているroomIdをここに入れる
            .here((users) => {
                this.usersInRoom = users;
            })
            .joining((user) => {
                this.usersInRoom.push(user);
            })
            .leaving((user) => {
                this.usersInRoom = this.usersInRoom.filter(u => u != user);
                //配列の各要素に対して条件式に当てはまるかチェックし当てはまるものだけで新しい配列を作る
            })
            .listen('MessagePosted',(e) => {
                //Handle event
                this.messages.push({
                    message: e.message.message,
                    user: e.user
                });
            });        
    }
});
