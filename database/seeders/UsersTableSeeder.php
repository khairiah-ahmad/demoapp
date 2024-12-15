<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::create(
            [
                "name" => "user1",
                "email" => "user1@gmail.com",
                "password" => "12345678",
            ]
        );

        // $factory = new UserFactory();
        // $factory->count(10)->create();

    }
}
