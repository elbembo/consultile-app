<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => 1,
            'name' => 'admin',
            'email' => 'admin@consultile.com',
            'password' => Hash::make('Hav$!)345k&@97!'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('users')->insert([
            'id' => 2,
            'name' => 'user',
            'email' => 'info@consultile.com',
            'password' => Hash::make('Con849562sa'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
