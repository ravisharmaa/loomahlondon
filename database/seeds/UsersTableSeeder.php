<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'      =>  'Marcus Paul',
            'email'     =>  'marcuspaul@mcpaul.com',
            'username'  =>  'cmsuser',
            'password'  =>  bcrypt('wit4permi55ion'),
        ]);
    }
}
