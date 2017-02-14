<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(array(
            'firstname' => 'Alain',
            'lastname'  => 'Nescolarde',
            'email'      => 'anescolarde@gmail.com',
            'password'   =>  Hash::make('secret')
        ));
    }
}
