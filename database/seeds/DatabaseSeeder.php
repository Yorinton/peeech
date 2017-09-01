<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PurposeMasterTableSeeder::class);
        $this->call(ActivityMasterTableSeeder::class);
        $this->call(IdolMasterTableSeeder::class);

    }
}
