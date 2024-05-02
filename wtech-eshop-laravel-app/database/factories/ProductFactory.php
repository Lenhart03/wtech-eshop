<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    
    public function definition()
    {
        $brands = ['AMD', 'Intel', 'GIGABYTE', 'NZXT', 'Asus','MSI',
            'Corsair', 'EVGA', 'G.Skill', 'Seagate', 'Western Digital',
            'Samsung', 'Crucial', 'Kingston', 'Thermaltake', 'Cooler Master',
            'be quiet!', 'Fractal Design', 'Phanteks', 'NZXT', 'Antec', 'SilverStone',
            'Lian Li', 'Deepcool', 'EKWB', 'Noctua', 'Arctic', 'Scythe', 'Razer', 'Logitech',
            'SteelSeries', 'HyperX', 'Sennheiser', 'Corsair', 'ASUS', 'Acer', 'LG', 'Samsung',
            'BenQ', 'Dell', 'HP', 'Lenovo', 'MSI', 'GIGABYTE', 'ASRock'];

        $productTypes = ['CPU', 'GPU', 'Motherboard', 'disk', 'case','ram','power supply','cooler'];

        $productBrand = $this->faker->randomElement($brands);
        $productName = $this->getName($productTypes, $productBrand);
        $description = $this->getDescription($productName, $productBrand);
        

        return [
            'name' => $productName.'$this->faker->numberBetween(1, 1000)',
            'description' => $description,
            'price' => $this->faker->randomFloat(2, 1, 1000),
            'count' => $this->faker->numberBetween(0, 100),
            'search_keys' => $this->faker->words(5, true),
            'brand' => $productBrand,
        ];
    }

    private function getName($productTypes, $productBrand)
    {
        $productName = $this->faker->randomElement($productTypes);

        switch ($productName) {
            case 'CPU':
                if ($productBrand == 'Intel') {
                    return $productName . ' ' . $this->faker->randomElement(['Intel Core i3', 'Intel Core i5', 'Intel Core i7', 'Intel Core i9']);
                }
                if ($productBrand == 'AMD') {
                    return $productName . ' ' . $this->faker->randomElement(['AMD Ryzen 3', 'AMD Ryzen 5', 'AMD Ryzen 7', 'AMD Ryzen 9']);
                }
                else {
                    return $productName . ' ' . $productBrand;
                }
            case 'GPU':
                return $this->faker->randomElement(['RTX 2050','RTX 2060','RTX 2070','RTX 2080',
                                                    'RTX 2050ti','RTX 2060ti','RTX 2070ti','RTX 2080ti',
                                                    'RTX 3050','RTX 3060','RTX 3070','RTX 3080',
                                                    'RTX 3050ti','RTX 3060ti','RTX 3070ti','RTX 3080ti',
                                                    'RTX 4050','RTX 4060','RTX 4070','RTX 4080',
                                                    'RTX 4050ti','RTX 4060ti','RTX 4070ti','RTX 4080ti',
                                                    'RX 5500','RX 5600','RX 5700','RX 5800',
                                                    'RX 5500 xt','RX 5600 xt','RX 5700 xt','RX 5800 xt',
                                                    'RX 6500','RX 6600','RX 6700','RX 6800',
                                                    'RX 6500 xt','RX 6600 xt','RX 6700 xt','RX 6800 xt',
                                                    'RX 7500','RX 7600','RX 7700','RX 7800',
                                                    'RX 7500 xt','RX 7600 xt','RX 7700 xt','RX 7800 xt'])
                                                    . ' ' . $productBrand . $this->faker->numberBetween(1,40). 'GB';
            case 'ram':
                return $productName . ' ' . $this->faker->numberBetween(4, 64) . 'GB ' . $this->faker->randomElement(['DDR3', 'DDR4', 'DDR5']);
            default:
                return $productName . ' ' . $productBrand;
        }
    }

    private function getDescription($productName,$productBrand)
    {
        switch ($productName) {
            case 'CPU':
                return 'Processor ' . $this->faker->numberBetween(1, 64) . '-jadrový, ' . 
                $this->faker->numberBetween(1, 128) . ' vlákien,' . $this->faker->randomFloat(2, 1, 5) . ' GHz'.
                $this->faker->randomFloat(2,1,5).' GHz boost' . $this->faker->numberBetween(1, 64) . ' MB L3 cache'.
                $this->faker->randomElement(['Bez', 's']) . ' integrovaným grafickým čipom';
            case 'GPU':
                return 'Grafická karta - ' . $this->faker->numberBetween(2, 16) . 'GB VRAM ' . 
                $this->faker->randomElement(['GDDR5', 'GDDR6']) . ' (' .
                $this->faker->numberBetween(5000,30000).' MHz)';
            case 'Motherboard':
                return 'Základná doska ' . $productBrand . ', Socket ' . $this->faker->randomElement(['AM4', 'LGA1200', 'TR4']) .
                'PCI Express' . $this->faker->randomElement(['3.0', '4.0','5.0']) . ', RAM ' . $this->faker->numberBetween(2, 5) .
                'x '.$this->faker->randomElement(['DDR3', 'DDR4', 'DDR5']) . ' (' . $this->faker->numberBetween(2000, 5000) . ' MHz)'.
                $this->faker->numberBetween(2,9) . 'x SATA III' . $this->faker->numberBetween(1,3) . 'x M.2, '.
                $this->faker->randomElement(['ATX', 'Micro ATX', 'Mini ITX']) . ' formát';
            case 'disk':
                return 'Pevný disk ' . $this->faker->numberBetween(10, 2048) . ' GB úložiska, '.
                $this->faker->randomElement(['HDD', 'SSD', 'NVMe']) . ', rýchlosť' . $this->faker->numberBetween(500, 5000) . ' MB/s';
            case 'case':
                return 'PC skiňa ' . $this->faker->randomElement(['ATX', 'Micro ATX', 'Mini ITX']) . ', '.
                $this->faker->numberBetween(1, 5) . 'x 2.5" slotov, ' . $this->faker->numberBetween(1, 5) . 'x 3.5" slotov, ' .
                $this->faker->numberBetween(3, 8) . 'x ventilátorov, ' . $this->faker->numberBetween(1, 5) . 'x USB 3.0';
            case 'ram':
                return 'Operačná pamäť ' . $this->faker->numberBetween(4, 64) . ' GB, ' . $this->faker->numberBetween(2000, 5000) . ' MHz, ' .
                $this->faker->randomElement(['DDR3', 'DDR4', 'DDR5']);
            case 'power supply':
                return 'PC zdroj ' . $this->faker->numberBetween(300, 1000) . 'W'.
                $this->faker->randomElement(['ATX', 'Micro ATX', 'Mini ITX']) . ' formát';
            case 'cooler':
                return 'Chladič ' . $this->faker->numberBetween(100, 4000) . ' RPM';
            default:
                return $this->faker->sentence;
        }
    }
    
}