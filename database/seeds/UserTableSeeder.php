<?php

use Illuminate\Database\Seeder;
use App\User;
class UserTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('user')->delete();
        User::create(array(
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'isAdmin' => true,
            'password' => Hash::make('admin'),
        ));

        User::create(array(
            'name' => 'User',
            'username' => 'user',
            'email' => 'user@gmail.com',
            'isAdmin' => false,
            'password' => Hash::make('user'),
        ));
    }

}
