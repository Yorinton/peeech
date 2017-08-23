<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()//db:seed Artisanコマンドが呼び出された時に実行される
    {
    	$masterData = ['握手会','ライブ','振りコピ','写真交換','オフ会','在宅派','創作','その他'];

		$activity = new App\Eloquent\ActivityMaster();
		$activity->activity = $masterData[2];
		$activity->save();


		$activity = new App\Eloquent\ActivityMaster();
		$activity->activity = $masterData[3];
		$activity->save();


		$activity = new App\Eloquent\ActivityMaster();
		$activity->activity = $masterData[4];
		$activity->save();


		$activity = new App\Eloquent\ActivityMaster();
		$activity->activity = $masterData[5];
		$activity->save();


		$activity = new App\Eloquent\ActivityMaster();
		$activity->activity = $masterData[6];
		$activity->save();


		$activity = new App\Eloquent\ActivityMaster();
		$activity->activity = $masterData[7];
		$activity->save();
		 
    }
}
