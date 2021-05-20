<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'user_id' => 0,
                'user_login' => 'admin',
                'user_pass' => 'pass',
                'user_nickname' => 'administrator',
                'user_email' => 'admin@example.com',
                'user_activation_key' => 'logout',
                'user_status' => 0,
            ],
            [
                'user_id' => 1,
                'user_login' => 'editer',
                'user_pass' => 'pass',
                'user_nickname' => 'editer',
                'user_email' => 'example@example.com',
                'user_activation_key' => 'logout',
                'user_status' => 1,
            ]
        ];

        foreach($users as $user){
            DB::table('users')->insert($user);
        }
    }
}
