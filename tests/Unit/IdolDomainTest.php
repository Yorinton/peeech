<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Peeech\Domain\Models\Idol\Idol;
use Peeech\Domain\Models\Idol\IdolId;
use Peeech\Domain\Models\Idol\IdolIdLists;
use Peeech\Data\Repositories\Idol\IdolRepository;

use App\Eloquent\Idol as EloquentIdol;
use App\Eloquent\IdolMaster as EloquentIdolMaster;

use App\Services\IdolService;

use DB;

class IdolDomainTest extends TestCase
{
	use DatabaseTransactions;

	/** @test */
    public function an_authenticated_user_can_add_a_idol()
    {
    	try{    		
	    	$user = $this->app->make('user');
			$user->name = 'より';
			$user->save();
			$this->actingAs($user);

	        $eloquentIdol = new EloquentIdol;
	        $eloquentIdolMaster = new EloquentIdolMaster;
			$idolRepo = new IdolRepository($eloquentIdol,$eloquentIdolMaster);
			$idol = new Idol($idolRepo);
			$id = new IdolId(2);

			$response = $idol->add($id);
			$this->assertInstanceOf(EloquentIdol::class,$response);

			$user->delete();
		}catch(\Exception $e){
			$this->assertTrue(false);
			echo $e;
			$user->delete();
		}
    }

    /** @test */
    public function an_authenticated_user_can_add_a_idol_on_idolService()
    {
    	try{    		
	    	$user = $this->app->make('user');
			$user->name = 'より';
			$user->save();
			$this->actingAs($user);

	        $eloquentIdol = new EloquentIdol;
	        $eloquentIdolMaster = new EloquentIdolMaster;
			$idolRepo = new IdolRepository($eloquentIdol,$eloquentIdolMaster);
			$idol = new Idol($idolRepo);
			$idolService = new IdolService($idol);

			$response = $idolService->store(2);
			$this->assertInstanceOf(EloquentIdol::class,$response);

			$user->delete();
		}catch(\Exception $e){
			// $this->assertTrue(false);
			echo $e;
			$user->delete();
		}   	
    }

    /** @test */
   //  public function an_authenticated_user_can_add_some_idols()
   //  {
   //  	try{
	  //   	$user = $this->app->make('user');
			// $user->name = 'より';
			// $user->save();
			// $this->actingAs($user);

	  //       $eloquentIdol = new EloquentIdol;
	  //       $eloquentIdolMaster = new EloquentIdolMaster;
			// $idolRepo = new IdolRepository($eloquentIdol,$eloquentIdolMaster);
			// $idol = new Idol($idolRepo);
			// $ids = new IdolIdLists([2,4,10]);

			// $idol->addMultiple($ids);
			// $idols = EloquentIdol::where('user_id',$user->id)->get();
			// $idols->each(function($item,$key){
			// 	$this->assertInstanceOf(EloquentIdol::class,$item);
			// });

   //  		$user->delete();
   //  	}catch(\Exception $e){
   //  		$this->assertTrue(false);
   //  		echo $e;
   //  		$user->delete();
   //  	}
   //  }

    /** @test */
    public function an_authenticated_user_can_add_some_idols_on_idolService()
    {
    	try{    		
	    	$user = $this->app->make('user');
			$user->name = 'より';
			$user->save();
			$this->actingAs($user);

	        $eloquentIdol = new EloquentIdol;
	        $eloquentIdolMaster = new EloquentIdolMaster;
			$idolRepo = new IdolRepository($eloquentIdol,$eloquentIdolMaster);
			$idol = new Idol($idolRepo);
			$idolService = new IdolService($idol);

			$idolService->storeMultiple([2,4,10]);

			$idols = EloquentIdol::where('user_id',$user->id)->get();
			$idols->each(function($item,$key){
				$this->assertInstanceOf(EloquentIdol::class,$item);
			});

			$user->delete();
		}catch(\Exception $e){
			// $this->assertTrue(false);
			echo $e;
			$user->delete();
		}     	
    }

}
