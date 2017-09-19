<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterPost as RegisterPost;
use App;
use App\Eloquent\Region;
use Intervention\Image\Facades\Image;
use App\MasterDbService;
use App\UserService;
use Request as RequestFacade;
use App\ImageService;
use Illuminate\Contracts\Encryption\DecryptException;
use App\MatchingService;
use Auth;

class UserController extends Controller
{
	use App\Libs\DisplayData;

	protected $masterDbService;
	protected $userService;
    protected $imageService;
    protected $matchingService;

	public function __construct(MasterDbService $masterDbService,UserService $userService,ImageService $imageService,MatchingService $matchingService)
	{
		$this->masterDbService = $masterDbService;
		$this->userService = $userService;
        $this->imageService = $imageService;
        $this->matchingService = $matchingService;
        $this->middleware('auth');
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

            $idol_masters = $this->masterDbService->getMaster('idol');
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
    public function store(RegisterPost $request,$id)
    {
        DB::beginTransaction();
        try{

            //Userのプロフィール情報などをDBに保存
            $user = $this->userService->getUser($id);
            $this->userService->createUserProfs($request,$id);
            $this->userService->createOtherProfs($request,$user,'idol');
            $this->userService->createOtherProfs($request,$user,'region');
            $this->userService->createOtherProfs($request,$user,'purpose');

            DB::commit();

            return redirect()->route('profiles',[$user]);

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
                $idol_masters = $this->masterDbService->getMaster('idol');
                $act_masters = $this->masterDbService->getMaster('activity');
                $prefs = json_encode($this->getPref());

                $title = 'プロフィール';

                return $this->chooseTemplate(compact('user','region','statue_ids','statue_masters','prefs','idol_masters','title','act_masters'));

    	}
    	echo '指定のユーザーは存在しません';                             
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
    	if($this->userService->getUser($id)){

	        $user = $this->userService->getUser($id);

          if($request->img_path){

            $this->imageService->upload($request,$id);
            return redirect()->route('profiles',[$user]);

          }
	        $this->userService->updateUserProfs($request,$id);

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
