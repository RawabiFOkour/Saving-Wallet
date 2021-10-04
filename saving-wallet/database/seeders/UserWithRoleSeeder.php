<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserWithRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            [
                'name'=>'User',
                'email'=>'user@gmail.com',
                'role'=>'1',
                'phone_number' => '0795674565',
                'password'=> bcrypt('12345678'),
            ],
            [
                'name'=>'Admin',
                'email'=>'admin@gmail.com',
                'role'=>'2',
                'phone_number' => '0795674345',
                'password'=> bcrypt('12341234'),
            ]
        ]);
    }
}
