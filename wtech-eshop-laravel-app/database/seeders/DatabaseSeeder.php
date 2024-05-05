<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;


use App\Models\Product;
use App\Models\Parameter;
use App\Models\image;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    
    public function run()
    {
        $products = Product::factory(200)->create();

        foreach ($products as $product) {
            $descriptionArray = explode(',', $product->description);
            
            switch ($product->category) {
                case 'CPU':
                    $arr=['AM4', 'LGA1200', 'LGA1151', 'TR4'];
                    $arr1=['2','4','6','8','12','16','32'];
                    $parameters = [
                        ['name' => 'Počet jadier', 'value' => $arr1[array_rand($arr1)]],
                        ['name' => 'Frekvencia', 'value' => $descriptionArray[2]],
                        ['name' => 'Boost', 'value' => $descriptionArray[3]],
                        ['name' => 'Výrobca', 'value' => $product->brand],
                        ['name' => 'Model', 'value' => $product->name],
                        ['name' => 'TDP', 'value' => rand(35, 200).' W'],
                        ['name' => 'Socket', 'value' => $arr[array_rand($arr)]],
                    ];
                    $images=[
                        ['image'=>'cpu-4393383_1280.jpg'],
                        ['image'=>'cpu-4393383_1280.jpg'],
                        ['image'=>'cpu-4393384_1280.jpg'],
                        ['image'=>'cpu-4393384_1280.jpg'],
                        ['image'=>'cpu-4393383_1280.jpg'],
                        ['image'=>'cpu-4393383_1280.jpg'],
                        ['image'=>'cpu-4393384_1280.jpg'],
                        ['image'=>'cpu-4393384_1280.jpg'],
                    ];
                    break;
                case 'GPU':
                    $arr1=['PCIe 3.0', 'PCIe 4.0', 'PCIe 5.0'];
                    $arr2=['HDMI', 'DisplayPort', 'DVI'];
                    $parameters = [
                        ['name' => 'Veľkosť pamäte', 'value' => rand(2, 24).' GB'],
                        ['name' => 'Frekvencia', 'value' => rand(1000, 5000).' MHz'],
                        ['name'=> 'Frekvencia pamäte', 'value' => rand(10000, 40000).' MHz'],
                        ['name' => 'Výrobca', 'value' => $product->brand],
                        ['name' => 'Model', 'value' => $product->name],
                        ['name' => 'TDP', 'value' => rand(35, 500).' W'],
                        ['name' => 'Rozhranie', 'value' => $arr1[array_rand($arr1)]],
                        ['name' => 'Výstupy', 'value' => $arr2[array_rand($arr2)]],
                        ['name' => 'Šírka', 'value' => rand(100, 400).' mm'],
                        ['name' => 'Výška', 'value' => rand(30, 100).' mm'],
                        ['name' => 'Hĺbka', 'value' => rand(50, 300).' mm'],
                    ];
                    $images=[
                        ['image'=>'gpu-1316015_1280.jpg'],
                        ['image'=>'graphics-card-6995934_1280.jpg'],
                        ['image'=>'gpu-1316015_1280.jpg'],
                        ['image'=>'graphics-card-6995934_1280.jpg'],
                        ['image'=>'gpu-1316015_1280.jpg'],
                        ['image'=>'graphics-card-6995934_1280.jpg'],
                        ['image'=>'gpu-1316015_1280.jpg'],
                        ['image'=>'graphics-card-6995934_1280.jpg'],
                    ];
                    break;
                case 'Motherboard':
                    $arr1=['ATX', 'Micro ATX', 'Mini ITX', 'E-ATX'];
                    $arr2=['B450', 'B550', 'X570', 'Z490', 'Z590'];
                    $arr3=['AM4', 'LGA1200', 'LGA1151', 'TR4'];
                    $arr4=['USB 3.0', 'USB 3.1', 'USB 3.2', 'USB 4.0', 'Thunderbolt 3'];
                    $parameters = [
                        ['name' => 'Formát', 'value' => $arr1[array_rand($arr1)]],
                        ['name' => 'Čipset', 'value' => $arr2[array_rand($arr2)]],
                        ['name' => 'Socket', 'value' => $arr3[array_rand($arr3)]],
                        ['name' => 'RAM sloty', 'value' => rand(2, 8)],
                        ['name' => 'Max RAM', 'value' => rand(16, 128).' GB'],
                        ['name' => 'Výrobca', 'value' => $product->brand],
                        ['name' => 'Model', 'value' => $product->name],
                        ['name' => 'Rozhrania', 'value' => $arr4[array_rand($arr4)]],
                        ['name' => 'PCIe sloty', 'value' => rand(1, 4)],
                        ['name' => 'M.2 sloty', 'value' => rand(1, 3)],
                        ['name' => 'SATA porty', 'value' => rand(2, 8)],
                    ];
                    $images=[
                        ['image'=>'cpu-4393375_1280.jpg'],
                        ['image'=>'motherboard-2202269_1280.jpg'],
                        ['image'=>'cpu-4393375_1280.jpg'],
                        ['image'=>'motherboard-2202269_1280.jpg'],
                        ['image'=>'cpu-4393375_1280.jpg'],
                        ['image'=>'motherboard-2202269_1280.jpg'],
                        ['image'=>'cpu-4393375_1280.jpg'],
                        ['image'=>'motherboard-2202269_1280.jpg'],
                    ];
                    break;
                case 'disk':
                    $arr=['HDD', 'SSD', 'NVMe'];
                    $parameters = [
                        ['name' => 'Kapacita', 'value' => rand(120, 2000).' GB'],
                        ['name' => 'Typ', 'value' => $arr[array_rand($arr)]],
                        ['name' => 'Rýchlosť', 'value' => rand(500, 5000).' MB/s'],
                        ['name' => 'Výrobca', 'value' => $product->brand],
                        ['name' => 'Model', 'value' => $product->name],
                    ];
                    $images=[
                        ['image'=>'hard-drive-503962_1280.jpg'],
                        ['image'=>'hdd-154463_1280.jpg'],
                        ['image'=>'hard-drive-503962_1280.jpg'],
                        ['image'=>'hdd-154463_1280.jpg'],
                        ['image'=>'hard-drive-503962_1280.jpg'],
                        ['image'=>'hdd-154463_1280.jpg'],
                        ['image'=>'hard-drive-503962_1280.jpg'],
                        ['image'=>'hdd-154463_1280.jpg'],
                    ];
                    break;
                case 'case':
                    $arr=['ATX', 'Micro ATX', 'Mini ITX'];
                    $parameters = [
                        ['name' => 'Formát', 'value' => $arr[array_rand($arr)]],
                        ['name' => 'Počet 2.5" slotov', 'value' => rand(1, 5)],
                        ['name' => 'Počet 3.5" slotov', 'value' => rand(1, 5)],
                        ['name' => 'Počet ventilátorov', 'value' => rand(3, 8)],
                        ['name' => 'Počet USB 3.0', 'value' => rand(1, 5)],
                        ['name' => 'Výrobca', 'value' => $product->brand],
                        ['name' => 'Model', 'value' => $product->name],
                    ];
                    $images=[
                        ['image'=>'anthony-roberts-fMbiAi0rbkA-unsplash.jpg'],
                        ['image'=>'anthony-roberts-FtP3ZM6hmNM-unsplash.jpg'],
                        ['image'=>'anthony-roberts-fMbiAi0rbkA-unsplash.jpg'],
                        ['image'=>'anthony-roberts-FtP3ZM6hmNM-unsplash.jpg'],
                        ['image'=>'anthony-roberts-fMbiAi0rbkA-unsplash.jpg'],
                        ['image'=>'anthony-roberts-FtP3ZM6hmNM-unsplash.jpg'],
                        ['image'=>'anthony-roberts-fMbiAi0rbkA-unsplash.jpg'],
                        ['image'=>'anthony-roberts-FtP3ZM6hmNM-unsplash.jpg'],
                    ];
                    break;
                case 'ram':
                    $arr=['DDR3', 'DDR4', 'DDR5'];
                    $parameters = [
                        ['name' => 'Kapacita', 'value' => rand(4, 64).' GB'],
                        ['name' => 'Typ', 'value' => $arr[array_rand($arr)]],
                        ['name' => 'Frekvencia', 'value' => rand(2000, 5000).' MHz'],
                        ['name' => 'Výrobca', 'value' => $product->brand],
                        ['name' => 'Model', 'value' => $product->name],
                    ];
                    $images=[
                        ['image'=>'memory-4704236_1280.jpg'],
                        ['image'=>'memory-4704236_1280.jpg'],
                        ['image'=>'memory-4704236_1280.jpg'],
                        ['image'=>'memory-4704236_1280.jpg'],
                        ['image'=>'memory-4704236_1280.jpg'],
                        ['image'=>'memory-4704236_1280.jpg'],
                        ['image'=>'memory-4704236_1280.jpg'],
                        ['image'=>'memory-4704236_1280.jpg'],
                    ];
                    break;
                case 'power supply':
                    $arr=['ATX', 'Micro ATX', 'Mini ITX'];
                    $parameters = [
                        ['name' => 'Výkon', 'value' => rand(300, 1000).' W'],
                        ['name' => 'Formát', 'value' => $arr[array_rand($arr)]],
                        ['name' => 'Výrobca', 'value' => $product->brand],
                        ['name' => 'Model', 'value' => $product->name],
                    ];
                    $images=[
                        ['image'=>'power-5209513_1280.jpg'],
                        ['image'=>'power-5209513_1280.jpg'],
                        ['image'=>'power-5209516_1280.jpg'],
                        ['image'=>'power-5209516_1280.jpg'],
                        ['image'=>'power-5209513_1280.jpg'],
                        ['image'=>'power-5209513_1280.jpg'],
                        ['image'=>'power-5209516_1280.jpg'],
                        ['image'=>'power-5209516_1280.jpg'],
                    ];
                    break;
                case 'cooler':
                    $parameters = [
                        ['name' => 'Rýchlosť', 'value' => rand(100, 4000).' RPM'],
                        ['name' => 'Výrobca', 'value' => $product->brand],
                        ['name' => 'Model', 'value' => $product->name],
                    ];
                    $images=[
                        ['image'=>'cooling-fan-7270527_1280.jpg'],
                        ['image'=>'computer-8129434_1280.jpg'],
                        ['image'=>'cooling-fan-7270527_1280.jpg'],
                        ['image'=>'computer-8129434_1280.jpg'],
                        ['image'=>'cooling-fan-7270527_1280.jpg'],
                        ['image'=>'computer-8129434_1280.jpg'],
                        ['image'=>'cooling-fan-7270527_1280.jpg'],
                        ['image'=>'computer-8129434_1280.jpg'],
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
            foreach ($images as $image) {
                image::create([
                    'product_id' => $product->id,
                    'image' => $image['image'],
                ]);
            }
        }
    }
}

