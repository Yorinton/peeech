<?php

namespace App\Services;

use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Libs\DisplayData as DisplayData;
use Request;
use DB;

class UserService
{
	use ValidatesRequests,DisplayData;

	public $userRepository;


	public function __construct(UserRepositoryInterface $userRepository)
	{
		$this->userRepository = $userRepository;
	}
	/*
	*
	* READ 取得
	*
	*/
	public function getUser($id)
	{
		return $this->userRepository->getUserById($id);
	}

	public function getOtherProfs($id,$tableName)
	{
		return $this->userRepository->getOtherProfsByUser($id,$tableName);
	}
	/*
	*
	* CREATE 新規作成
	*
	*/
	public function createUserProfs($request,$id)
	{
        //プロフィール情報などをDBに保存
        $this->userRepository->createUserProfsById($request,$id);
	}

	public function createOtherProfs($request,$user,$key)
	{
		if($key === 'idol' || $key === 'favorite' || $key === 'event'){
			$keyForArr = 'added_'.$key.'.*';
		}else {
			$keyForArr = $key.'.*';
		}
        if($request->input($keyForArr) !== null){
            foreach ($request->input($keyForArr) as $value) {
                if($value !== null){
                	$this->userRepository->createOtherProfsByUser($user,$key,$value);
                }
            }
    	}		
	}
	/*
	*
	* UPDATE 更新
	*
	*/	
	//userのidとリクエストを受け取ってテーブルをupdateするメソッド
	public function updateUserProfs($request,$id)
	{
		//リクエストの配列からkeyとvalueを取り出す
 		foreach (Request::all() as $key => $value) {
 			//keyがテーブルに存在するもの以外の場合は弾く
	        if($key !== '_token' && $key !== '_method' && $key !== 'id'){
				//バリデーションルールの配列
				$rules = [
					'name' => ['name' => 'required|max:255'],
					'email' => ['email' => 'required|email|unique:users,email'],
					'sex' => ['sex' => 'required|max:11'],
					'introduction' => ['introduction' => 'required|max:1000'],
				];
				//バリデート実施
				$this->validate($request,$rules[$key]);
				//DBに保存
				return $this->userRepository->updateUserProfsById($id,$key,$value);
			}
		}
	}

	public function updateUserProfsSimple($id,$key,$value)
	{
		$this->userRepository->updateUserProfsById($id,$key,$value);
	}

	public function addOtherProfsSingle($request,$user,$key)
	{
        if($request->$key){
        	$rules = [
        		'idol' => ['idol' => 'required|max:255'],
        		'favorite' => ['favorite' => 'required|max:255'],
        		'event' => ['event' => 'required|max:255'],
        		'region' => ['region' => 'required|max:255'],
        		'activity' => ['activity' => 'required|max:255'],
        		'statue_id' => ['statue_id' => 'required'],
        	];
          	$this->validate($request,$rules[$key]);

          	//DBへ保存
          	return $this->userRepository->addOtherProfsSingleByUser($request,$user,$key);
        }
    }		

	public function editOtherProfsSingle($request,$user,$key)
	{
		if($request->$key){
        	$rules = [
        		'region' => ['region' => 'required|max:255'],
        	];
        	//テーブル編集
        	return $this->userRepository->editOtherProfsSingleByUser($request,$user,$key);
		}
	}

	public function updateOtherProfsMultiple($request,$user,$key)
	{
		//_idの有無で$columnを定義
		if(strpos($key,'_id') !== false){
			$column = substr($key, 0,-3);
		}else{
			$column = $key;
		}

		if($request->$column){

        	$rules = [
        		'region' => ['region' => 'required|max:255'],
        		'purpose' => ['purpose' => 'required'],
        		'statue' => ['statue' => 'required'],
        	];
          	$this->validate($request,$rules[$column]);

    		$columns = $column.'s';//regions
    		//DB登録済みのデータのオブジェクトを全て取得(オブジェクトの配列)
	        $db_datas = $user->$columns;
	        //DB登録済みデータからオブジェクトの配列を生成し、必要なカラムのデータのみの配列に変換
		    $indexDatas = $this->objArrToPropArr($db_datas,$key);

			$this->userRepository->updateOtherProfsMultipleByUser($request,$user,$key,$indexDatas);
		}
	}

	/*
	*
	* DELETE 削除
	*
	*/
	public function deleteProfs($id,$modelName)
	{
		$this->userRepository->deleteProfsById($id,$modelName);
	}

}





?>