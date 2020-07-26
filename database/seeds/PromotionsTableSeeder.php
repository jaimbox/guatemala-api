<?php
use App\Promotion;
use Illuminate\Database\Seeder;

class PromotionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Promotion::truncate();

        $faker = \Faker\Factory::create('en_EN');

        for ($i = 0; $i < 50; $i++) {
            Promotion::create([
                'title' => $faker->sentence(3),
                'price' => $faker->randomNumber(2),
                'address' => $faker->streetAddress,
                'latitude' => $faker->latitude,
                'longitude' => $faker->longitude,
            ]);
        }
    }
}
