<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Factories\UserFactory;
use Faker\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Luong Quoc tuan2',
            'email' =>'tuan1234562809@gmail.com',
            'password' => Hash::make('Tuan28092000@'),
            'phone'=>'0368952267',
            'role'=>'admin'
        ]);
//        User::factory()->count(10)->create();
    }
}
