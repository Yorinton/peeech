<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterPost as RegisterPost;
use App;
use App\Eloquent\Region;
use Intervention\Image\Facades\Image;
use App\MasterDbService;
use App\Services\UserService;
use Peeech\Application\Services\Idol\IdolService;
use Request as RequestFacade;
use App\ImageService;
use Illuminate\Contracts\Encryption\DecryptException;
use App\MatchingService;
use Auth;
use Gate;
use Cache;

class UserController extends Controller
{
	use App\Libs\DisplayData;

	protected $masterDbService;
	protected $userService;
    protected $imageService;
    protected $matchingService;
    protected $idolService;
    protected $is_production;

    public function __construct(MasterDbService $masterDbService,UserService $userService,ImageService $imageService,MatchingService $matchingService,IdolService $idolService)
	{
		$this->masterDbService = $masterDbService;
		$this->userService = $userService;
        $this->imageService = $imageService;
        $this->matchingService = $matchingService;
        $this->idolService = $idolService;
        $this->middleware('auth');
        $this->is_production = env('APP_ENV') === 'production' ? true : false;

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        if(Auth::id() === (int)$id){

            $user = $this->userService->getUser($id);

            $idol_masters = $this->idolService->getAllIdols();
//            $idol_masters = $this->masterDbService->getMaster('idol');
            $purpose_masters = $this->masterDbService->getMaster('purpose');
            $prefs = $this->getPref();

            $title = '利用登録';


            return view('register')->with("prefs",$prefs)
            					   ->with('user',$user)
            					   ->with('idol_masters',$idol_masters)
                                   ->with('purpose_masters',$purpose_masters)
                                   ->with('title',$title);
        }
        return '指定のユーザーは存在しません';

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //$requestに入力されたプロフィール情報が入る
    public function store(RegisterPost $request,$id)
    {

        DB::beginTransaction();
        try{

            //Userのプロフィール情報などをDBに保存
            $user = $this->userService->getUser($id);
            $this->userService->createUserProfs($request,$id);
            $this->idolService->storeMultiple($request->added_idol);
            $this->userService->createOtherProfs($request,$user,'region');
//            $this->userService->createOtherProfs($request,$user,'purpose');

            DB::commit();

//            return redirect()->route('profiles',[$user]);
            return redirect('/profiles/'.$user->id,302,[],$this->is_production);

        }catch(\Exception $e){
        
            DB::rollback();
            echo $e;

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!$this->userService->hasCreated($id)){
            return redirect('/registerpage/'.$id,302,[],$this->is_production);
        }

        //usersテーブル
    	if($this->userService->getUser($id)){
        		//user関連情報を取得 + 整形
        		$user = $this->userService->getUser($id);
                $user->email = $this->decryptData($user->email);
                $user->birthday = $this->birthdayFormat($user->birthday);
                $user->sex = $this->sexFormat($user->sex);
                $region = $user->regions->first() !== null ? $user->regions->first() : Region::init($user->id,'東京都');

                //選択されたstatue_idを配列に格納
                $statue_ids = json_encode($this->objArrToPropArr($user->statues,'statue_id'));

                //各マスタデータ
                $statue_masters = $this->masterDbService->getMaster('statue');
                // $idol_masters = $this->masterDbService->getMaster('idol');
                $idol_masters = $this->idolService->getAllIdols();
                $act_masters = $this->masterDbService->getMaster('activity');
                $prefs = json_encode($this->getPref());

                $title = 'プロフィール';

                //初回アクセスかどうか(登録画面からの遷移かどうか)の判定
                $tutorial = $this->isFirstAccessToProfilePage();

                return $this->chooseTemplate(compact('user','region','statue_ids','statue_masters','prefs','idol_masters','title','act_masters','tutorial'));

    	}
    	echo '指定のユーザーは存在しません';                             
    }

    public function isFirstAccessToProfilePage()
    {
        if(isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'],'registerpage')){
            return true;
        }
        return false;
    } 

    /**
     * Choose Template of displaying profile (user or friend)
     *
     * @param  array  $datas
     * @return View
     */    
    public function chooseTemplate($datas)
    {
        return view('profile',$datas);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
    	if($this->userService->getUser($id)){

            $user = $this->userService->getUser($id);

            if(Gate::denies('update-user',$user)){
                echo '指定のユーザー情報は更新出来ません';
            }

	        $this->userService->updateUserProfs($request,$id);

        }
        echo '指定のユーザーは存在しません';

    }

    public function updateImage(Request $request,$id)
    {
        if ($user = $this->userService->getUser($id)) {

            if (!$request->img_path) {
                return '画像が指定されていません。「画像を設定」ボタンから画像を指定して再度お試し下さい';
            }

            $this->imageService->upload($request, $id);
            return redirect()->route('profiles', [$user]);

        }
        echo '指定のユーザーは存在しません';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request,$id)
    {
        if($id){
            if($request->key){
                $this->userService->deleteProfs($id,$request->key);
            }
            // return redirect()->route('profiles',['id' => $user_id]);
            return ['result' => '成功'];   
        }
    }
}
