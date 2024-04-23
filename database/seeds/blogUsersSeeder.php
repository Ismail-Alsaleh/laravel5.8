<?php

use Illuminate\Database\Seeder;
use Faker\factory as Faker;

class blogUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 80) as $index) {
            DB::table('blog_users')->insert([
                'username' => $faker->unique()->name,
                'gender' => 'male',
                'email' => $faker->unique()->safeEmail,
                'password' => bcrypt('password'),
            ]);
        }
    }
}
