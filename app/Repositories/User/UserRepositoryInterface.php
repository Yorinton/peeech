<?php

namespace App\Repositories\User;

/**
* 
*/
interface UserRepositoryInterface
{
	
	public function getUserById($id);

	public function getOtherProfsByUser($id,$tableName);

	public function createUserProfsById($request,$id);

	public function createOtherProfsByUser($id,$key,$value);

	public function updateUserProfsById($id,$key,$value);

	public function updateOtherProfsSingleByUser($request,$user,$key);

	public function updateOtherProfsMultipleByUser($request,$user,$key,$indexDatas);

}


?>