<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatueMasterTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //後から一つずつ追加する場合
//        $statue = '';
//
//        $statue_master = new App\Eloquent\StatueMaster();
//        $statue_master->statue = $statue;
//        $statue_master->save();


        //全体をリセットする場合
//        DB::delete('delete from statue_masters');
//        DB::statement('alter table statue_masters auto_increment = 1');

//        $statues = ['同年代','同性','異性OK','トレードOK','現場で気軽に絡める','イベント同行/連番OK','気軽にアイドル話をしたい','聖地巡礼したい','振りコピしたい','オフ会したい','グッズ購入代行します','色々教えて','色々教えます'];
//
//        foreach ($statues as $statue) {
//        	$statue_master = new App\Eloquent\StatueMaster();
//        	$statue_master->statue = $statue;
//        	$statue_master->save();
//        }


    }
}
