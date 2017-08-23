<?php

namespace App\Repositories\Master;

interface MasterRepositoryInterface
{
	//Master系テーブルからデータを取得
	public function getMasterData($modelName);
}

?>