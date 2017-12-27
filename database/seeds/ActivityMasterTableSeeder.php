<?php

use App\Eloquent\ActivityMaster;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActivityMasterTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::delete('delete from activity_masters');
        DB::statement('alter table activity_masters auto_increment = 1');

		$activities = ['握手会','ライブ','聖地巡礼','振りコピ','トレード','オフ会','在宅派','創作','ゲーム','その他'];
		foreach ($activities as $activity) {
			$activity_master = new App\Eloquent\ActivityMaster();
			$activity_master->activity = $activity;
			$activity_master->save();
		}

    }
}
