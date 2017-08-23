<?php


use App\Events\MessagePosted;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});



/**
 *
 * プロフィール
 *
**/

// プロフィール登録画面表示
// Route::get('/registerpage','UserController@index');
Route::get('/registerpage/{id}','UserController@index')->name('registerpage');
// プロフィール情報登録(初期)
Route::post('/profiles/{id}','UserController@store');
// プロフィール情報取得
Route::get('/profiles/{id}','UserController@show')->name('profiles');
// プロフィール情報更新 - usersテーブル
Route::patch('/users/{id}','UserController@update');
// プロフィール情報更新 - その他プロフィール情報
Route::post('/users/{id}','UserController@update');
Route::put('/users/{id}','UserController@update');
Route::delete('/users/{user_id}/{id}','UserController@destroy');

/**
 *
 * 今日のファン友候補
 *
**/

//今日のファン友画面取得
Route::get('/friends/{id}','RecommendController@show')->name('friends');
//ジャッジ結果登録
Route::post('/matchings/{from_user_id}','RecommendController@judge');

/**
 *
 * マッチング相手
 *
**/

//マッチング相手一覧取得
Route::get('/matchings/{id}','MatchingController@show');


/**
 *
 * SNS認証
 *
**/
// プロバイダの認証ページにリダイレクトする
Route::get('login/{provider}','Auth\SocialAccountController@redirectToProvider');
// プロバイダからのコールバックを受け取る
Route::get('login/{provider}/callback','Auth\SocialAccountController@handleProviderCallback');
// SNS認証後、プロフィールページにリダイレクト
Route::get('/home/{id}', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@subindex');

/**
 *
 * メッセージ関連
 *
**/
// チャットルーム作成
Route::post('/room','RoomController@setRoom');

// チャットルーム入室(取得)
Route::get('/room/{room_id}','RoomController@getRoom')->name('room');

//ルーム内メッセージ取得
Route::get('/messages/{room_id}',function($room_id){
	//全メッセージが取得されてしまう => 特定のroom_idにひもづくものだけ取得するよう変更
	return App\Eloquent\Message::with('user')->where('room_id',$room_id)->get();
})->middleware('auth');

//メッセージの保存
Route::post('/messages',function(){
	//Store tne new message
	$user = Auth::user();

	$message = new App\Eloquent\Message();
	$message->message = request('message');
	$message->room_id = request('roomId');//おいおい編集
	$user->messages()->save($message);

	//roomsのupdated_atを更新する
	$room = App\Eloquent\Room::where('id',$message->room_id)->first();
	App\Eloquent\Room::where('id',$message->room_id)->update(['from_user_id' => $room->from_user_id]);

	//Announce that a new message has been posted
	broadcast(new MessagePosted($message,$user))->toOthers();

	return ["message" => request('message')];

})->middleware('auth');

//ルーム一覧取得
Route::get('/rooms/{id}','RoomController@show');

Auth::routes();

//アイドル名取得&DB登録
// Route::get('/idols',function(){
// 	$i;
// 	for ($i=1; $i < 47; $i++) {
// 		if(Goutte::request('GET', 'http://idolscheduler.jp/artist/?ai_id='.$i)){
// 			$crawler = Goutte::request('GET', 'http://idolscheduler.jp/artist/?ai_id='.$i);
// 			$idols = $crawler->filter('#artist_box > ul > li > dl > dt > p.name > em > a')->each(function($node){
// 					return $node->text();
// 			});
// 			foreach ($idols as $idol) {
// 				if(!App\Eloquent\IdolMaster::where('idol',$idol)->exists()){
// 					$idol_master = new App\Eloquent\IdolMaster();
// 					$idol_master->idol = $idol;
// 					$idol_master->phonetic_id = $i;
// 					$idol_master->save();

// 					echo $idol.'/';			
// 				}
// 			}

// 		}
// 	}

// });



// Route::get('/register', function () {
//     return redirect()->route('login');
// });

//どっかで認可処理を記述する
// Route::resource('users','UserController');
// Route::resource('purposes','PurposeController');
// Route::resource('idols','IdolController');
// Route::resource('favorites','FavoriteController');
// Route::resource('events','EventController');
// Route::resource('regions','RegionController');
// Route::resource('statues','RegionController');
// Route::resource('judges','JudgeController');


