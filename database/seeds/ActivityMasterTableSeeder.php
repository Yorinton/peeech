<?php

use Illuminate\Database\Seeder;

class ActivityMasterTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$activities = ['握手会','ライブ','聖地巡礼','振りコピ','トレード','オフ会','在宅派','創作','その他'];
		foreach ($activities as $activity) {
			$activity_master = new App\Eloquent\ActivityMaster();
			$activity_master->activity = $activity;
			$activity_master->save();
		}

    }
}
