<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transaction;
use App\Models\Customer;
use Faker\Factory as Faker;

class TransactionSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $customers = Customer::pluck('id')->toArray();

        for ($i = 0; $i < 50; $i++) {
            Transaction::create([
                'date' => $faker->dateTimeBetween('-1 year', 'now'),
                'customer_id' => $faker->randomElement($customers),
                'total' => $faker->numberBetween(10000, 2000000),
                'payment_method' => $faker->randomElement(['tunai', 'kredit']),
                'status' => $faker->randomElement(['lunas', 'belum_lunas', 'batal']),
            ]);
        }
    }
}
