<?php

namespace App\Repositories\User;


use App\Eloquent\User;
use App\Eloquent\IdolMaster;
use App\Eloquent\Region;
use App\Eloquent\Favorite;
use Illuminate\Support\Facades\DB;

/**
* 
*/
class UserRepository implements UserRepositoryInterface
{
	

	protected $user;

	public function __construct(User $user)
	{
		$this->user = $user;
	}
	/*
	*
	* READ 取得
	*
	*/
	public function getUserById($id)
	{
		if($this->user->where('id',$id)->exists()){
			return $this->user->where('id',$id)->first();
		}
		return false;
	}

	public function getOtherProfsByUser($id,$tableName)
	{
		$user = $this->getUserById($id);
		return $user->$tableName;
	}
	/*
	*
	* CREATE 新規作成
	*
	*/
	public function createUserProfsById($request,$id)
	{
        $user = $this->getUserById($id);//SNS認証で作成したUserに変更予定
        $user->name = $request->name;
        // $user->email = encrypt($request->email);
        $user->sex = $request->sex;
        // $user->introduction = $request->introduction;
        $user->birthday = $request->year."-".$request->month."-".$request->day;
        $user->save();
	}

	public function createOtherProfsByUser($user,$key,$value)
	{
		$string = 'App\\Eloquent\\'.ucfirst($key);
	    $model = new $string;
		if($key === 'statue' || $key === 'purpose'){
			$key_id = $key.'_id';
			$model->$key_id = $value;
		}else{    
	    	$model->$key = $value;
		}
		if($key === 'idol'){
			$idol_id = IdolMaster::where('idol',$value)->first()->id;
			$model->idol_id = $idol_id;
		}
		$model->user_id = $user->id;	    
	    $model->save();
	}
	/*
	*
	* UPDATE 更新
	*
	*/
	public function updateUserProfsById($id,$key,$value)
	{
		$user = $this->getUserById($id);
		if($key === 'email'){
			$value = encrypt($value);
		}
		$user->$key = $value;
		$user->save();
	}

	public function addOtherProfsSingleByUser($request,$user,$key)
	{
		DB::beginTransaction();
		try{
			//_idの有無で$keyを定義
			if(strpos($key,'_id') !== false){
				$column = substr($key, 0,-3);
			}else{
				$column = $key;
			}
	        $string = 'App\\Eloquent\\'.ucfirst($column);		
	      	$model = new $string;
	      	$model->$key = $request->$key;
	      	$model->user_id = $user->id;
	      	if($key === 'idol'){
	          	$idol_id = IdolMaster::where('idol',$request->idol)->first()->id;
	          	$model->idol_id = $idol_id;
	      	}
	      	$model->save();
	      	DB::commit();
      	}catch(\Exception $e){
      		DB::rollback();
      		echo $e;
      		exit();
      	}
	}

	public function editOtherProfsSingleByUser($request,$user,$key)
	{

		DB::beginTransaction();
		try{
			$className = 'App\\Eloquent\\'.ucfirst($key);
			$model = $className::where('user_id',$user->id)->first();
			$model->$key = $request->$key;
			$model->save();

			DB::commit();
		}catch(\Exception $e){
			DB::rollback();
			echo $e;
			exit();
		}
	}

	public function updateOtherProfsMultipleByUser($request,$user,$key,$indexDatas)
	{
		DB::beginTransaction();
		try{
			//_idの有無で$columnを定義
			if(strpos($key,'_id') !== false){
				$column = substr($key, 0,-3);
			}else{
				$column = $key;
			}
	    	//新規入力されたデータの中にDBのデータが無ければそのデータをDBから削除
	        foreach ($indexDatas as $indexData){
	            if(!in_array($indexData, $request->$column)){
	            	$string = 'App\\Eloquent\\'.ucfirst($column);
	            	$model = $string::where($key,$indexData)->where('user_id',$user->id)->delete();
	            }
	        }
        	//DBのデータの中に新規入力されたデータが無ければそのデータをDBに登録
	        foreach ($request->$column as $data) {
	            if (isset($data)) {
	              	if(!in_array($data, $indexDatas)){
	              		$string = 'App\\Eloquent\\'.ucfirst($column);
		                $new_data = new $string;
		                $new_data->$key = $data;
		                $new_data->user_id = $user->id;
		                $new_data->save();
	              	}
	            }
	        }
	        DB::commit();
    	}catch(\Exception $e){
    		DB::rollback();
    		echo $e;
    		exit();
    	}		
	}
	/*
	*
	* DELETE 削除
	*
	*/
	public function deleteProfsById($id,$modelName)
	{
		$string = 'App\\Eloquent\\'.ucfirst($modelName);
		$model = $string::where('id',$id)->delete();		
	}

}

?>