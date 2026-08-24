<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->count(4)->create();

        DB::table('users')->insert([
        'name' => 'Admin',
        'email' => 'admin@email.com',
        'password' => bcrypt('senha'),
        'permission' => 'admin'
        ]); 
    }
}
