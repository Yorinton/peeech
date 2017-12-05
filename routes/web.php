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
 * プロフィール関連
 *
**/
// プロフィール登録画面表示
Route::get('/registerpage/{id}','UserController@index')->name('registerpage');

// プロフィール情報登録(初期)
Route::post('/profiles/{id}','UserController@store');

// プロフィール情報取得
Route::get('/profiles/{id}','UserController@show')->name('profiles');

// プロフィール情報更新
Route::patch('/user/{id}','UserController@update');
Route::patch('/image/{id}','UserController@updateImage');
Route::patch('/region/{id}','RegionController@update');

// プロフィール情報追加
Route::post('/idol/{user_id}','IdolController@store');
Route::post('/favorite/{user_id}','FavoriteController@store');
Route::post('/event/{user_id}','EventController@store');
Route::post('/activity/{user_id}','ActivityController@store');
Route::post('/statue/{user_id}','StatueController@store');

// プロフィール情報削除
Route::delete('/users/{id}','UserController@delete');


/**
 *
 * レコメンド関連
 *
**/
//今日のファン友画面取得
Route::get('/friends/{id}','RecommendController@list')->name('friends');

//ファン友のプロフィール画面
Route::get('/friend/{id}/{friend_id}','FriendController@showProfile');

//ジャッジ結果登録
Route::post('/matchings/{from_user_id}','RecommendController@judge');


/**
 *
 * マッチング関連
 *
**/
//マッチング相手一覧取得
Route::get('/matchings/{id}','MatchingController@showMatchedFriends');


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
Route::get('/room/{room_id}','RoomController@showRoom')->name('room');

//ルーム内メッセージ取得
Route::get('/messages/{room_id}','MessageController@index')->middleware('auth');

//メッセージの保存
Route::post('/messages','MessageController@store')->middleware('auth');

//ルーム一覧取得
Route::get('/rooms/{id}','RoomController@showChatLists');

//メッセージ既読
Route::post('/messages/receive','MessageReceiveController@receive')->middleware('auth');

//メッセージ通知
Route::post('/messages/notify','MessageReceiveController@notify')->middleware('auth');

/**
 *
 * メッセージ関連
 *
**/
//Route::get('/mail','MailController@sendMail');

/**
 *
 * PCアクセス時のリダイレクト
 *
 **/

Route::get('/pc','RedirectController@pc')->name('pc');



/**
 *
 * 認証関連
 *
**/
Auth::routes();


// アイドル名取得&DB登録
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


