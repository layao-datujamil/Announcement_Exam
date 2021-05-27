<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user1 = User::create([
            "name" => "Datu Jamil Layao",
            "email" => "layaodatujamil@gmail.com",
            "password" => Hash::make("Exam2021"),
        ]);
    }
}
