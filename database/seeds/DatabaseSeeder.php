<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
 
    public function run()
    {
        $this->call(UserTableSeeder::class);
        $this->call(TeamTableSeeder::class);
        $this->call(PlayersTableSeeder::class);
        
    }
}
