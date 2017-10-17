<?php

use Illuminate\Database\Seeder;

use Faker\Factory;
use App\Eloquent\User;
use App\Eloquent\LinkedSocialAccount;
use App\Eloquent\Idol;
use App\Eloquent\IdolMaster;
use App\Eloquent\Region;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()//db:seed Artisanコマンドが呼び出された時に実行される
    {

    	$faker = Faker\Factory::create();

	    	DB::beginTransaction();
	    	try{
    			for ($i=1; $i < 5 ; $i++) {
			    	$user = new User();
			    	$user->name = 'テストユーザー'.$i;
			    	$user->email = encrypt($i.'aaaa@gmail.com');
			    	$user->sex = 'male';
			    	$user->birthday = $faker->date('Y-m-d', 'now');
			    	$user->img_path = '../../images/img01.jpg';
			    	$user->introduction = $faker->sentence(10);
			    	$user->password = $faker->sha256;
			    	$user->save();

			    	$social = new LinkedSocialAccount();
			    	$social->provider_name = 'twitter';
			    	$social->provider_id = $faker->isbn13;
			     	$user->accounts()->save($social);

			     	$idol = new Idol();
			     	$idol_master = IdolMaster::where('id',65)->first();
			     	$idol->idol = $idol_master->idol;
			     	$idol->idol_id = $idol_master->id;
			     	$user->idols()->save($idol);

			     	$region = new Region();
			     	$region->region = '福岡県';
			     	$user->regions()->save($region);
		     	}
			    DB::commit();

	     	}catch(\Exception $e){
	     		DB::rollback();
	     		echo $e;
	     	}
    }
}
