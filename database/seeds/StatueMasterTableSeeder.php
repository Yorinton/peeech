<?php

use Illuminate\Database\Seeder;

class StatueMasterTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statues = ['同年代','同性','異性OK','トレードOK','現場で気軽に絡める','イベント同行/連番OK','気軽にアイドル話をしたい','聖地巡礼したい','振りコピしたい','オフ会したい','色々教えて','色々教えます'];

        foreach ($statues as $statue) {
        	$statue_master = new App\Eloquent\StatueMaster();
        	$statue_master->statue = $statue;
        	$statue_master->save();
        }
    }
}
