<?php

use Illuminate\Database\Seeder;
use App\Team;

class TeamTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('team')->delete();
        Team::create(array(
            'name' => 'Orlando City',
            'logoUri' => 'https://www.google.com/search?q=soccer+team+logos&tbm=isch&source=iu&ictx=1&fir=C6g00A3PgEqz_M%253A%252CL1ld-yBK2pSJfM%252C_&usg=AI4_-kSDgJrloZprU9L-sQMY_TtzkRmqsw&sa=X&ved=2ahUKEwistc2YzMDgAhWVTn0KHZ4pB98Q9QEwCnoECAAQGA&biw=1327&bih=672'
        ));

        Team::create(array(
            'name' => 'FC Dallass',
            'logoUri' => 'https://www.google.com/url?sa=i&source=images&cd=&cad=rja&uact=8&ved=2ahUKEwjIxcPvzMDgAhVacCsKHdeGCQAQjRx6BAgBEAU&url=https%3A%2F%2Fwww.washingtonpost.com%2Fnews%2Fsoccer-insider%2Fwp%2F2014%2F10%2F09%2Fwhat-are-the-best-mls-team-logos-my-choices-in-order-and-a-reader-poll%2F&psig=AOvVaw0PQYoMbKAs2snUFHt2-Rc3&ust=1550418253964875'
        ));
    }

}
