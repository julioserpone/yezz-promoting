<?php

use App\Product;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$products = [
            ['brand' => 'YEZZ', 'model' => '4.7T',
                'features' => [
                    'screen_size' => '4.7',
                    'screen_resolution' => 'HD',
                    'processor_speed' => '1.2',
                    'number_of_cores' => '4',
                    'rear_camera' => '8MP',
                    'front_camera' => '2MP',
                    'battery' => '1780',
                    '3g_connectivity' => 'yes',
                    '4g_connectivity' => 'no',
                    'fingerprint_reader' => 'no',
                    'ram' => '1GB',
                    'rom' => '8GB',
                    'sd_memory_capacity' => '64GB',
                    'so' => 'Android 4.4 KitKat (Dugger)',
                ]
            ],
            ['brand' => 'YEZZ', 'model' => '5.5M LTE VR',
                'features' => [
                    'screen_size' => '5.5',
                    'screen_resolution' => 'HD',
                    'processor_speed' => '1.0',
                    'number_of_cores' => '4',
                    'rear_camera' => '13MP',
                    'front_camera' => '5MP',
                    'battery' => '2400',
                    '3g_connectivity' => 'yes',
                    '4g_connectivity' => 'yes',
                    'fingerprint_reader' => 'no',
                    'ram' => '1GB',
                    'rom' => '8GB',
                    'sd_memory_capacity' => '64GB',
                    'so' => 'Android 5.0 Lollipop',
                ]
            ],
            ['brand' => 'YEZZ', 'model' => '5M LTE',
                'features' => [
                    'screen_size' => '5.0',
                    'screen_resolution' => 'HD',
                    'processor_speed' => '1.0',
                    'number_of_cores' => '4',
                    'rear_camera' => '13MP',
                    'front_camera' => '5MP',
                    'battery' => '2200',
                    '3g_connectivity' => 'yes',
                    '4g_connectivity' => 'yes',
                    'fingerprint_reader' => 'no',
                    'ram' => '1GB',
                    'rom' => '8GB',
                    'sd_memory_capacity' => '64GB',
                    'so' => 'Android 5.0 Lollipop',
                ]
            ],
            ['brand' => 'YEZZ', 'model' => '5M',
                'features' => [
                    'screen_size' => '5.0',
                    'screen_resolution' => 'HD',
                    'processor_speed' => '1.3',
                    'number_of_cores' => '4',
                    'rear_camera' => '8MP',
                    'front_camera' => '5MP',
                    'battery' => '2300',
                    '3g_connectivity' => 'yes',
                    '4g_connectivity' => 'no',
                    'fingerprint_reader' => 'no',
                    'ram' => '1GB',
                    'rom' => '8GB',
                    'sd_memory_capacity' => '64GB',
                    'so' => 'Android 6.0 Marshmallow',
                ]
            ],
            ['brand' => 'YEZZ', 'model' => '5E LTE',
                'features' => [
                    'screen_size' => '5.0',
                    'screen_resolution' => 'FWVGA',
                    'processor_speed' => '1.0',
                    'number_of_cores' => '4',
                    'rear_camera' => '8MP',
                    'front_camera' => '5MP',
                    'battery' => '2000',
                    '3g_connectivity' => 'yes',
                    '4g_connectivity' => 'yes',
                    'fingerprint_reader' => 'no',
                    'ram' => '1GB',
                    'rom' => '8GB',
                    'sd_memory_capacity' => '64GB',
                    'so' => 'Android 6.0 Marshmallow',
                ]
            ],
            ['brand' => 'YEZZ', 'model' => '4.5E LTE',
                'features' => [
                    'screen_size' => '4.5',
                    'screen_resolution' => 'FWVGA',
                    'processor_speed' => '1.0',
                    'number_of_cores' => '4',
                    'rear_camera' => '5MP',
                    'front_camera' => '2MP',
                    'battery' => '1700',
                    '3g_connectivity' => 'yes',
                    '4g_connectivity' => 'yes',
                    'fingerprint_reader' => 'no',
                    'ram' => '1GB',
                    'rom' => '8GB',
                    'sd_memory_capacity' => '64GB',
                    'so' => 'Android 6.0 Marshmallow',
                ]
            ],
            ['brand' => 'YEZZ', 'model' => '5E 3',
                'features' => [
                    'screen_size' => '5.0',
                    'screen_resolution' => 'FWVGA',
                    'processor_speed' => '1.3',
                    'number_of_cores' => '4',
                    'rear_camera' => '5MP',
                    'front_camera' => '2MP',
                    'battery' => '2000',
                    '3g_connectivity' => 'yes',
                    '4g_connectivity' => 'no',
                    'fingerprint_reader' => 'no',
                    'ram' => '512MB',
                    'rom' => '8GB',
                    'sd_memory_capacity' => '64GB',
                    'so' => 'Android 6.0 Marshmallow',
                ]
            ],
            ['brand' => 'YEZZ', 'model' => '4E 4',
                'features' => [
                    'screen_size' => '4.0',
                    'screen_resolution' => 'FWVGA',
                    'processor_speed' => '1.2',
                    'number_of_cores' => '4',
                    'rear_camera' => '5MP',
                    'front_camera' => '2MP',
                    'battery' => '1400',
                    '3g_connectivity' => 'yes',
                    '4g_connectivity' => 'no',
                    'fingerprint_reader' => 'no',
                    'ram' => '512MB',
                    'rom' => '4GB',
                    'sd_memory_capacity' => '64GB',
                    'so' => 'Android 6.0 Marshmallow',
                ]
            ],
            ['brand' => 'YEZZ', 'model' => '3.5E 2',
                'features' => [
                    'screen_size' => '3.5',
                    'screen_resolution' => 'HVGA',
                    'processor_speed' => '1.0',
                    'number_of_cores' => '2',
                    'rear_camera' => '2MP',
                    'front_camera' => '1.3MP',
                    'battery' => '1300',
                    '3g_connectivity' => 'yes',
                    '4g_connectivity' => 'no',
                    'fingerprint_reader' => 'no',
                    'ram' => '512MB',
                    'rom' => '4GB',
                    'sd_memory_capacity' => '64GB',
                    'so' => 'Android 4.4 KitKat (Dugger)',
                ]
            ],
            ['brand' => 'YEZZ', 'model' => '4E 2',
                'features' => [
                    'screen_size' => '4',
                    'screen_resolution' => 'WVGA',
                    'processor_speed' => '1.0',
                    'number_of_cores' => '2',
                    'rear_camera' => '5MP',
                    'front_camera' => '1.3MP',
                    'battery' => '1400',
                    '3g_connectivity' => 'yes',
                    '4g_connectivity' => 'no',
                    'fingerprint_reader' => 'no',
                    'ram' => '512MB',
                    'rom' => '4GB',
                    'sd_memory_capacity' => '32GB',
                    'so' => 'Android 4.4 KitKat (Dugger)',
                ]
            ],
            ['brand' => 'YEZZ', 'model' => '5T',
                'features' => [
                    'screen_size' => '5',
                    'screen_resolution' => 'HD',
                    'processor_speed' => '1.3',
                    'number_of_cores' => '4',
                    'rear_camera' => '13MP',
                    'front_camera' => '5MP',
                    'battery' => '1800',
                    '3g_connectivity' => 'yes',
                    '4g_connectivity' => 'no',
                    'fingerprint_reader' => 'no',
                    'ram' => '1GB',
                    'rom' => '8GB',
                    'sd_memory_capacity' => '64GB',
                    'so' => 'Android 4.4 KitKat (Dugger)',
                ]
            ],
            ['brand' => 'YEZZ', 'model' => 'C50',
                'features' => [
                    'screen_size' => '1.8',
                    'screen_resolution' => 'QQVGA',
                    'rear_camera' => 'VGA',
                    'battery' => '600',
                    '3g_connectivity' => 'no',
                    '4g_connectivity' => 'no',
                    'fingerprint_reader' => 'no',
                    'sd_memory_capacity' => '8GB',
                ]
            ],
            ['brand' => 'YEZZ', 'model' => 'C24',
                'features' => [
                    'screen_size' => '1.8',
                    'screen_resolution' => 'QQVGA',
                    'rear_camera' => 'VGA',
                    'battery' => '600',
                    '3g_connectivity' => 'no',
                    '4g_connectivity' => 'no',
                    'fingerprint_reader' => 'no',
                    'sd_memory_capacity' => '8GB',
                ]
            ],
            ['brand' => 'YEZZ', 'model' => 'C21',
                'features' => [
                    'screen_size' => '1.8',
                    'screen_resolution' => 'QQVGA',
                    'rear_camera' => 'VGA',
                    'battery' => '600',
                    '3g_connectivity' => 'no',
                    '4g_connectivity' => 'no',
                    'fingerprint_reader' => 'no',
                    'sd_memory_capacity' => '8GB',
                ]
            ],
        ];

        $yezzBrand = ['YEZZ', 'NIU'];
        foreach ($products as $product) {
            Product::create([
                'brand' => $product['brand'],
                'model' => $product['model'],
                'name' => $product['brand'].' '.$product['model'],
                'features' => json_encode($product['features']),
                'is_yezz' => (in_array($product['brand'], $yezzBrand)) ? 1 : 0
            ]);
        }
    }
}