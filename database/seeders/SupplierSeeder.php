<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Supplier;
use Faker\Factory as Faker;

class SupplierSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        for ($i = 0; $i < 50; $i++) {
            Supplier::create([
                'name' => $faker->company,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
                'total_purchase' => $faker->numberBetween(1000000, 100000000),
                'notes' => $faker->sentence,
                'image' => null, // bisa isi path gambar dummy kalau perlu
            ]);
        }
    }
}
