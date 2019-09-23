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
        App\User::create([
            'email' => 'admin@gmail.com',
            'name' => 'Admin',
            'isadmin' => 1,
            'password' => app('hash')->make('admin')
        ]);
    }
}
