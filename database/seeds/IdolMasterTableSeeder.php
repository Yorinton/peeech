<?php

use Illuminate\Database\Seeder;
use Goutte;

class IdolMasterTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$i;
		for ($i=1; $i < 47; $i++) {
			if(Goutte::request('GET', 'http://idolscheduler.jp/artist/?ai_id='.$i)){
				$crawler = Goutte::request('GET', 'http://idolscheduler.jp/artist/?ai_id='.$i);
				$idols = $crawler->filter('#artist_box > ul > li > dl > dt > p.name > em > a')->each(function($node){
						return $node->text();
				});
				foreach ($idols as $idol) {
					if(!App\Eloquent\IdolMaster::where('idol',$idol)->exists()){
						$idol_master = new App\Eloquent\IdolMaster();
						$idol_master->idol = $idol;
						$idol_master->phonetic_id = $i;
						$idol_master->save();

						echo $idol.'/';			
					}
				}

			}
		}
    }
}
