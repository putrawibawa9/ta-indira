<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Supplier;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $suppliers = Supplier::pluck('id')->toArray();

        for ($i = 0; $i < 50; $i++) {
            Product::create([
                'name' => $faker->word . ' ' . $faker->randomElement(['Premium', 'Super', 'Ekstra']),
                'description' => $faker->sentence,
                'price' => $faker->numberBetween(5000, 500000),
                'stock' => $faker->numberBetween(1, 100),
                'supplier_id' => $faker->randomElement($suppliers),
                'image' => null,
            ]);
        }
    }
}
