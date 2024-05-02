<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;


use App\Models\Product;
use App\Models\Parameter;
use Database\Factories\ParameterFactory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $products = Product::factory(10)->create();

        foreach ($products as $product) {
            Parameter::factory()->for($product)->create();
        }
    }
}

