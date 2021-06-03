<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(array(
            [
                'name' => 'Wahyu Pratama',
                'email' => 'wahyu@gmail.com',
                'password' => bcrypt('password'),
                'foto' => 'user.png',
                'level' => 1
            ],
            [
                'name' => 'Annisa Nabil',
                'email' => 'nabil@gmail.com',
                'password' => bcrypt('password'),
                'foto' => 'user.png',
                'level' => 2
            ]
        ));
    }
}
