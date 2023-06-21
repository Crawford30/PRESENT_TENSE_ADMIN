<?php

use App\User;
use Illuminate\Support\Str;
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
        $user = \App\User::updateOrCreate(
            ["id" => 1],
            [
                "name" => "ADMIN",
                "email" => "info@presenttense.com",
                "type" => "admin",
                "user_status" => "ACTIVATED",
                "dvd_access_status" => "ALL_DVD",
                "password" => bcrypt("@admin#present@tense"),
                'api_token' => Str::random(60),
            ]
        );
    }
}
