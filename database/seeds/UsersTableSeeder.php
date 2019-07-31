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
            'name' => 'Superadmin',
            'email' => 'superadmin@email.com',
            'is_admin' => 1,
            'is_super_user' => 1,
            'password' => bcrypt('Super@123'),
        ]);
        DB::table('users')->insert([
            'name' => 'user2',
            'email' => 'user2@email.com',
            'is_admin' => 1,
            'password' => bcrypt('Admin@123'),
        ]);
        DB::table('users')->insert([
            'name' => 'User',
            'email' => 'User@email.com',
            'password' => bcrypt('User@123'),
        ]);
    }
}
