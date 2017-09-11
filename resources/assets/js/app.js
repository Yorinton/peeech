
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('./prof');

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
        // message・user・roomId・img_pathという4つのプロパティを持つオブジェクトをmessageという名前でaddMessage()の引数に指定
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

        if($(".room_id").length > 0){
            var roomId = $(".room_id").text();

        	//このインスタンスが作成された際に、指定のURLに非同期でリクエストする
        	axios.get('/messages/' + roomId).then(response => {
        		this.messages = response.data;
        		// console.log(response);
        	});
        }
        Echo.join('chatroom.' + roomId)// 入室しているroomIdをここに入れる
            //チャンネルを購入している全ユーザー情報を含む配列を返す
            .here((users) => {
                this.usersInRoom = users;
            })
            //新たに参加したユーザー情報
            .joining((user) => {
                this.usersInRoom.push(user);
            })
            //離脱したユーザー情報
            .leaving((user) => {
                this.usersInRoom = this.usersInRoom.filter(u => u != user);
                //配列の各要素に対して条件式に当てはまるかチェックし当てはまるものだけで新しい配列を作る
            })
            .listen('MessagePosted',(e) => {
                //Handle event
                this.messages.push({
                    //MessagePostedイベントクラスのプロパティ
                    message: e.message.message,
                    user: e.user
                });
            });    
    },
    beforeUpdate(){
        //room.blade.php表示時に最新メッセージを表示する
        if($(".room_id").length > 0){
            var bodyHeight = $('body').height() + 100;
            console.log(bodyHeight);
            $('body').scrollTop(bodyHeight);
        }
    },
    updated(){
        // 最新メッセージ表示
        var bodyHeight = $('body').height() + 100;
        console.log(bodyHeight);
        $(document).scrollTop(bodyHeight);
    }
});
