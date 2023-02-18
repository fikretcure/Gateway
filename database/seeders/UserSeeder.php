<?php

namespace Database\Seeders;

use App\Http\Repositories\UserRepository;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        (new UserRepository())->store([
            "name" => "fikret",
            "surname" => "cure",
            "email" => rand(),
            "password" => "Fikret-1461"
        ]);
    }
}
