<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use App;
use Intervention\Image\Facades\Image;
use App\MasterDbService;
use App\UserService;
use Request as RequestFacade;
use App\ImageService;

class UserController extends Controller
{
	use App\Libs\DisplayData;

	protected $masterDbService;
	protected $userService;
    protected $imageService;

	public function __construct(MasterDbService $masterDbService,UserService $userService,ImageService $imageService)
	{
		$this->masterDbService = $masterDbService;
		$this->userService = $userService;
        $this->imageService = $imageService;
        $this->middleware('auth');
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id = null)
    {
        //47都道府県
        $prefs = $this->getPref();

        //DBからアイドル一覧取得
        $idol_masters = $this->masterDbService->getMaster('idol');

        $title = '利用登録';

        if($id){
            $user = $this->userService->getUser($id);
	        // $user = App\Eloquent\User::where('id',$id)->first();
	        // return redirect()->route('profiles',[$user]);
	        return view('register')->with("prefs",$prefs)
	        					   ->with('user',$user)
	        					   ->with('idol_masters',$idol_masters)
                                   ->with('title',$title);
        }else{
        	return view('login');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //$requestに入力されたプロフィール情報が入る
    public function store(Request $request,$id)
    {

        //バリデーション
        //ControllerクラスのValidatesRequestsトレイトのvalidateメソッドを使う
        $this->validate($request,[
                'name' => 'required|max:255',
                // 'email' => 'required|email|unique:users,email',
                'sex' => 'required|max:11',
                // 'introduction' => 'required|max:1000',
                'year' => 'required|integer',
                'month' => 'required|integer',
                'day' => 'required|integer',
                'added_idol' => 'required',
            ]);

        //トランザクション
        DB::beginTransaction();
        try{

            //Userのプロフィール情報などをDBに保存
            $user = $this->userService->getUser($id);
            $this->userService->createUserProfs($request,$id);

            //idolsテーブルに保存

            $this->userService->createOtherProfs($request,$user,'idol');
            // $this->userService->createOtherProfs($request,$user,'favorite');
            // $this->userService->createOtherProfs($request,$user,'region');
            // $this->userService->createOtherProfs($request,$user,'statue');
            $this->userService->createOtherProfs($request,$user,'purpose');
            // $this->userService->createOtherProfs($request,$user,'event');

            DB::commit();
            $result = true;

        }catch(\Exception $e){
        
            DB::rollback();
            echo $e;
            // return back()->withInput()->with('e','プロフィール登録に失敗しました。再度お試し下さい');
            // return redirect()->with('e','プロフィール登録に失敗しました。再度お試し下さい');
        
        }
        //レスポンスデータを返す
        if($result){
            // return redirect()->route('profiles',['id' => $user->id]);
            return redirect()->route('profiles',[$user]);//Eloquentモデルを渡すと自動的にidを取り出す
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
        //usersテーブル
        if(isset($id)){
            if($id !== null){
            	if($this->userService->getUser($id)->exists()){
            		//user情報を取得
            		$user = $this->userService->getUser($id);
                    $birthArr = explode('-',$user->birthday);
                    
	                //usesテーブルに関連する各テーブルのモデルを取得
            		$idols = $this->userService->getOtherProfs($id,'idols');
            		$favorites = $this->userService->getOtherProfs($id,'favorites');
            		$regions = $this->userService->getOtherProfs($id,'regions');
            		$purposes = $this->userService->getOtherProfs($id,'purposes');
            		$statues = $this->userService->getOtherProfs($id,'statues');
            		$events = $this->userService->getOtherProfs($id,'events');
                    $activities = $this->userService->getOtherProfs($id,'activities');

			        //選択された利用目的のpurpose_id,regionを配列にする(マスターとの比較用)
			        $purpose_ids = $this->objArrToPropArr($purposes,'purpose_id');
			        $statue_ids = $this->objArrToPropArr($statues,'statue_id');
			        $region_names = $this->objArrToPropArr($regions,'region');
                    $activity_names = $this->objArrToPropArr($activities,'activity');

			        //47都道府県
			        $prefs = $this->getPref();

			        //各マスタデータ
			        $purpose_masters = $this->masterDbService->getMaster('purpose');
			        $statue_masters = $this->masterDbService->getMaster('statue');
			        $idol_masters = $this->masterDbService->getMaster('idol');
                    $act_masters = $this->masterDbService->getMaster('activity');

                    $title = 'プロフィール';

			        //変数をprofile.blade.phpに渡す(viewでforeachを回す)
			        return view('profile')->with('user',$user)
                                          ->with('birthArr',$birthArr)
			                              ->with('idols',$idols)
			                              ->with('favorites',$favorites)
			                              // ->with('region_names',$region_names)
			                              ->with('regions',$regions)
			                              ->with('purpose_ids',$purpose_ids)
			                              ->with('statue_ids',$statue_ids)
			                              ->with('events',$events)
			                              ->with('purpose_masters',$purpose_masters)
			                              ->with('statue_masters',$statue_masters)
			                              ->with('prefs',$prefs)
			                              ->with('idol_masters',$idol_masters)
                                          ->with('title',$title)
                                          ->with('activity_names',$activity_names)
                                          ->with('act_masters',$act_masters);

            	}
            	echo '指定のユーザーは存在しない';
            }
        }                              
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    	if($this->userService->getUser($id)->exists()){

    		//認証中のUser取得
	        $user = $this->userService->getUser($id);

	        //usersテーブル情報のアップデート
	        if($request->name || $request->sex || $request->email || $request->introduction){
	        	//リクエストに応じてUserのプロフィールをアップデート
	        	$this->userService->updateUserProfs($request,$id);
	    	}
            if($request->year && $request->month && $request->day){
                $rules = [
                    'year' => 'required|integer',
                    'month' => 'required|integer',
                    'day' => 'required|integer',
                ];
                $this->validate($request,$rules);               
                $birthday = $request->year."-".$request->month."-".$request->day;
                $this->userService->updateUserProfsSimple($id,'birthday',$birthday);
            }
            //一つずつ登録するパターンのデータのアップデート
	        if($request->idol || $request->favorite || $request->event || $request->region || $request->activity){
				$this->userService->updateOtherProfsSingle($request,$user,'idol');
				$this->userService->updateOtherProfsSingle($request,$user,'favorite');
				$this->userService->updateOtherProfsSingle($request,$user,'event');
                $this->userService->updateOtherProfsSingle($request,$user,'region');
                $this->userService->updateOtherProfsSingle($request,$user,'activity');
			}

			//複数登録パターンデータのアップデート
			if($request->purpose || $request->statue){
				$this->userService->updateOtherProfsMultiple($request,$user,'region');
				$this->userService->updateOtherProfsMultiple($request,$user,'purpose_id');
				$this->userService->updateOtherProfsMultiple($request,$user,"statue_id");			
			}
			//画像アップロード
	        if($request->img_path){

                $this->imageService->upload($request,$id);
	        }
	        return redirect()->route('profiles',[$user]);

        }
        echo '指定のユーザーは存在しません';

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$user_id,$id)
    {
        //
        if($id){
            if($request->idol || $request->favorite || $request->event || $request->region){
                $this->userService->deleteProfs($id,'idol');
                $this->userService->deleteProfs($id,'favorite');
                $this->userService->deleteProfs($id,'event');
                $this->userService->deleteProfs($id,'region');    
            }
            return redirect()->route('profiles',['id' => $user_id]);   
        }
    }
}
