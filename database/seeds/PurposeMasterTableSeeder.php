<?php

use Illuminate\Database\Seeder;

class PurposeMasterTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $purposes = ['握手会やライブの連番や同行者が欲しい','好きなアイドルの話ができる気軽な友達が欲しい','オフ会や振りコピ等やりたい活動を一緒に出来る友達が欲しい','年代・推しメン等、共通点が多い友達が欲しい'];

        foreach ($purposes as $purpose) {
        	$purpose_master = new App\Eloquent\PurposeMaster();
        	$purpose_master->purpose = $purpose;
        	$purpose_master->save();
        }

    }
}
