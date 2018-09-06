<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for($i = 0; $i < 10; $i++) {
          User::create([
                'password' => $faker->password,
                'name' => $faker->name,
                'email' => $faker->email
            ]);
        }
    }
}
