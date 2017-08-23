<?php

namespace Tests\Browser;

use App\Eloquent\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ExampleTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $this->browse(function ($first, $second) {
            // $first->loginAs(User::find(1))
            //       ->visit('/room')
            //       ->waitFor('.chat-composer');

            // $second->loginAs(User::find(2))
            //        ->visit('/room')
            //        ->waitFor('.chat-composer')
            //        ->type('#message', 'Hey Taylor')//セレクタを指定出来る
            //        ->press('Send');

            // $first->waitForText('Hey Taylor')
            //       ->assertSee('Yorihiro Katsuki');
        });
    }
}
