<?php

namespace Database\Seeders;

 use App\Repositories\UserRepository;
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
            "email" => "fikretcure@yandex.com",
            "password" => "Fikret-1461"
        ]);
    }
}
