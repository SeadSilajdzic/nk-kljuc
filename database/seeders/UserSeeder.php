<?php

namespace Database\Seeders;

use App\Models\Dashboard\User\User;
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
        User::create([
            'name' => 'Admin1',
            'email' => 'admin1@admin.com',
            'password' => bcrypt('password'),
            'isAdmin' => 1,
            'isMember' => 1,
            'status' => 1,
            'phone' => '1252363474'
        ]);

        User::create([
            'name' => 'Admin2',
            'email' => 'admin2@admin.com',
            'password' => bcrypt('password'),
            'isAdmin' => 1,
            'isMember' => 1,
            'status' => 1,
            'phone' => '1252363474'
        ]);


        User::create([
            'name' => 'Admin 3',
            'email' => 'admin3@admin.com',
            'password' => bcrypt('password'),
            'isAdmin' => 1,
            'isMember' => 1,
            'status' => 1,
            'phone' => '1252363474'
        ]);


        User::factory()->count(2500)->create();
    }
}
