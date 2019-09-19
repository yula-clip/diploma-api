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
        App\Models\User::create([
            'login' => 'admin',
            'password' => app('hash')->make('p@ssw0rd')
        ]);
    }
}
