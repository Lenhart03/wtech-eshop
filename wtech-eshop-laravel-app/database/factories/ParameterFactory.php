<?php

namespace Database\Factories;
use App\Models\Parameter;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;

class ParameterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
        ];
    }

    /**
     * Define the model's state specific to a product.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function withProduct(Product $product)
    {
        $parameters = [];

        switch ($product->type) {
            case 'CPU':
                $parameters = [
                    ['name' => 'Počet jadier', 'value' => $this->faker->numberBetween(1,64)],
                    ['name' => 'Frekvencia', 'value' => $this->faker->randomFloat(2, 1, 5).' GHz'],
                    ['name' => 'Boost', 'value' => $this->faker->randomFloat(2, 3, 6).' GHz'],
                    ['name' => 'Výrobca', 'value' => $product->brand],
                    ['name' => 'Model', 'value' => $product->name],
                    ['name' => 'TDP', 'value' => $this->faker->numberBetween(35, 200).' W'],
                    ['name' => 'Socket', 'value' => $this->faker->randomElement(['AM4', 'LGA1200', 'LGA1151', 'TR4'])],
                ];
                break;
            case 'GPU':
                $parameters = [
                    ['name' => 'Veľkosť pamäte', 'value' => $this->faker->numberBetween(2, 24).' GB'],
                    ['name' => 'Frekvencia', 'value' => $this->faker->randomFloat(2, 1000, 5000).' MHz'],
                    ['name'=> 'Frekvencia pamäte', 'value' => $this->faker->randomFloat(2, 10000, 40000).' MHz'],
                    ['name' => 'Výrobca', 'value' => $product->brand],
                    ['name' => 'Model', 'value' => $product->name],
                    ['name' => 'TDP', 'value' => $this->faker->numberBetween(35, 500).' W'],
                    ['name' => 'Rozhranie', 'value' => $this->faker->randomElement(['PCIe 3.0', 'PCIe 4.0', 'PCIe 5.0'])],
                    ['name' => 'Výstupy', 'value' => $this->faker->randomElement(['HDMI', 'DisplayPort', 'DVI'])],
                    ['name' => 'Šírka', 'value' => $this->faker->numberBetween(100, 400).' mm'],
                    ['name' => 'Výška', 'value' => $this->faker->numberBetween(30, 100).' mm'],
                    ['name' => 'Hĺbka', 'value' => $this->faker->numberBetween(50, 300).' mm'],
                ];
                break;
            case 'Motherboard':
                $parameters = [
                    ['name' => 'Formát', 'value' => $this->faker->randomElement(['ATX', 'Micro ATX', 'Mini ITX', 'E-ATX'])],
                    ['name' => 'Čipset', 'value' => $this->faker->randomElement(['B450', 'B550', 'X570', 'Z490', 'Z590'])],
                    ['name' => 'Socket', 'value' => $this->faker->randomElement(['AM4', 'LGA1200', 'LGA1151', 'TR4'])],
                    ['name' => 'RAM sloty', 'value' => $this->faker->numberBetween(2, 8)],
                    ['name' => 'Max RAM', 'value' => $this->faker->numberBetween(16, 128).' GB'],
                    ['name' => 'Výrobca', 'value' => $product->brand],
                    ['name' => 'Model', 'value' => $product->name],
                    ['name' => 'Rozhrania', 'value' => $this->faker->randomElement(['USB 3.0', 'USB 3.1', 'USB 3.2', 'USB 4.0', 'Thunderbolt 3'])],
                    ['name' => 'PCIe sloty', 'value' => $this->faker->numberBetween(1, 4)],
                    ['name' => 'M.2 sloty', 'value' => $this->faker->numberBetween(1, 3)],
                    ['name' => 'SATA porty', 'value' => $this->faker->numberBetween(2, 8)],
                ];
                break;
            case 'disk':
                $parameters = [
                    ['name' => 'Kapacita', 'value' => $this->faker->numberBetween(120, 2000).' GB'],
                    ['name' => 'Typ', 'value' => $this->faker->randomElement(['HDD', 'SSD', 'NVMe'])],
                    ['name' => 'Rýchlosť', 'value' => $this->faker->numberBetween(500, 5000).' MB/s'],
                    ['name' => 'Výrobca', 'value' => $product->brand],
                    ['name' => 'Model', 'value' => $product->name],
                ];
                break;
            case 'case':
                $parameters = [
                    ['name' => 'Formát', 'value' => $this->faker->randomElement(['ATX', 'Micro ATX', 'Mini ITX', 'E-ATX'])],
                    ['name' => 'Počet 2.5" slotov', 'value' => $this->faker->numberBetween(1, 5)],
                    ['name' => 'Počet 3.5" slotov', 'value' => $this->faker->numberBetween(1, 5)],
                    ['name' => 'Počet ventilátorov', 'value' => $this->faker->numberBetween(3, 8)],
                    ['name' => 'Počet USB 3.0', 'value' => $this->faker->numberBetween(1, 5)],
                    ['name' => 'Výrobca', 'value' => $product->brand],
                    ['name' => 'Model', 'value' => $product->name],
                ];
                break;
            case 'ram':
                $parameters = [
                    ['name' => 'Kapacita', 'value' => $this->faker->numberBetween(4, 64).' GB'],
                    ['name' => 'Typ', 'value' => $this->faker->randomElement(['DDR3', 'DDR4', 'DDR5'])],
                    ['name' => 'Frekvencia', 'value' => $this->faker->numberBetween(2000, 5000).' MHz'],
                    ['name' => 'Výrobca', 'value' => $product->brand],
                    ['name' => 'Model', 'value' => $product->name],
                ];
                break;
            case 'power supply':
                $parameters = [
                    ['name' => 'Výkon', 'value' => $this->faker->numberBetween(300, 1000).' W'],
                    ['name' => 'Formát', 'value' => $this->faker->randomElement(['ATX', 'Micro ATX', 'Mini ITX'])],
                    ['name' => 'Výrobca', 'value' => $product->brand],
                    ['name' => 'Model', 'value' => $product->name],
                ];
                break;
            case 'cooler':
                $parameters = [
                    ['name' => 'Rýchlosť', 'value' => $this->faker->numberBetween(100, 4000).' RPM'],
                    ['name' => 'Výrobca', 'value' => $product->brand],
                    ['name' => 'Model', 'value' => $product->name],
                ];
                break;
            
        }

        foreach ($parameters as $parameter) {
            Parameter::create([
                'product_id' => $product->id,
                'name' => $parameter['name'],
                'value' => $parameter['value'],
            ]);
        }
    }
}