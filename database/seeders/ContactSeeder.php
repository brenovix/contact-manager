<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $contacts = [];
        for ($i = 0; $i < 10; $i++) {
            $faker = Factory::create();
            $phone = substr(preg_replace("/[^\d]/", '', $faker->phoneNumber()), 0, 9);
            $contacts[] = [
                'name' => $faker->name,
                'email' => $faker->email,
                'contact' => $phone,
                'created_at' => DB::raw('now()')
            ];
        }
        DB::table('contacts')->insert($contacts);
    }
}
