<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker; //https://github.com/fzaninotto/Faker

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();


        DB::table('users')->insert([
            'name' => 'Test',
            'email' => 'test@testas.com',
            'password' => Hash::make('123'),
        ]);

        $makersCount = 20;
        foreach (range(1, $makersCount) as $_) {
            DB::table('makers')->insert([
                'name' => $faker->firstName(),


            ]);
        }
        $cars = ['Mercedes', 'BMW', 'AUDI', 'JEEP', 'SKODA', 'RENAULT', 'GAZ'];
        foreach (range(1, 200) as $_) {
            DB::table('cars')->insert([
                'name' => $cars[rand(0, count($cars) - 1)],
                'plate' => $faker->userName(),
                'about' => $faker->paragraph(2),
                'maker_id' => rand(1, $makersCount),
            ]);
        }
    }
}