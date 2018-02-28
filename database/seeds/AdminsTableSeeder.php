<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory('App\Admin',3)->create(['password'=> bcrypt('123456')]); //创建密码为123的管理员

    }
}
