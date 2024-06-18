<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = config('users_db.users');
        foreach ($users as $user) {

            $newUser = new User();
            $newUser->user_name = $user['user_name'];
            $newUser->lastname = $user['lastname'];
            $newUser->user_email = $user['user_email'];
            $newUser->password = $user['password'];
            $newUser->save();
        }
    }
}
