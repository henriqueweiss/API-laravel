<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    // Henrique - ajustado https://laravel.com/docs/9.x/seeding
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'henrique weiss',
            'email' => 'henrique.weiss@gmail.com',
            'password' => Hash::make('123456'),
        ]);
    }
}
