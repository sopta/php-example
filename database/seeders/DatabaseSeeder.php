<?php

declare(strict_types=1);

use Illuminate\Database\Seeder;
use Illuminate\Database\Capsule\Manager as Capsule;
use function Symfony\Component\Clock\now;

return new class extends Seeder
{
    public function run(): void
    {
        $faker = Faker\Factory::create();

        $id = Capsule::table('order')->insertGetId([
            'email' => $faker->email(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $totalPrice = 0;
        $iterations = $faker->numberBetween(1, 5);
        for ($i = 0; $i < $iterations; $i++) {
            $price = $faker->randomFloat(2, 1, 100);
            $totalPrice += $price;

            Capsule::table('order_item')->insert([
                'order_id' => $id,
                'name' => $faker->name(),
                'price' => $price,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        Capsule::table('order')->update([
            'total' => $totalPrice,
        ]);

        $iterations = $faker->numberBetween(1, 5);
        for ($i = 0; $i < $iterations; $i++) {
            Capsule::table('product')->insert([
                'name' => $faker->name(),
                'price' => $faker->randomFloat(2, 1, 100),
                'is_public' => $faker->boolean(),
                'is_available' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
};
