<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Eloquent\Idol as Idol;
use App\Eloquent\IdolMaster as IdolMaster;

use App\Services\IdolService;
use App\Repositories\Idol\IdolRepository;
use App\Repositories\Idol\IdolRepositoryInterface;

use App;

class IdolTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

    use App\Libs\DisplayData;

    /** @test */
    public function authenticated_user_can_add_a_idol()
    {
        try{
            //make authenticated user
            $user = $this->app->make('user');
            $user->name = 'より';
            $user->save();
            $this->actingAs($user);

            //make instances
            $idol = new Idol;
            $idol_master = new IdolMaster;
            $idolRepo = new IdolRepository($idol,$idol_master);
            $idolService = new IdolService($idolRepo);

            //store idol by idol_id
            $idolService->store(2);

            //get idol of user
            $idol = Idol::where('user_id',$user->id)->first();
            $idol_name = $idol->idol;

            //assert correct idol name
            $this->assertContains($idol_name,'アイドルカレッジ');

            //delete user and idols
            $user->delete();
        }catch(\Exception $e){
            $user->delete();
        }
    }

    /** @test */
    public function authenticated_user_can_add_some_idols()
    {
        try{
            $user = $this->app->make('user');
            $user->name = 'より';
            $user->save();
            $this->actingAs($user);

            //make instances
            $idol = new Idol;
            $idol_master = new IdolMaster;
            $idolRepo = new IdolRepository($idol,$idol_master);
            $idolService = new IdolService($idolRepo);

            $idolService->storeMultiple([1,2]);

            $idols = Idol::where('user_id',$user->id)->get();
            $idol_names = $this->objArrToPropArr($idols,'idol');

            $this->assertContains('AIS',$idol_names);
            $this->assertContains('アイドルカレッジ',$idol_names);

            $user->delete();
        }catch(\Exception $e){
            $user->delete();
        }
    }
}
