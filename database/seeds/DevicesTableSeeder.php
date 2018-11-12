<?php

use Illuminate\Database\Seeder;

class DevicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$devices = [
    		"screen_size" => [
    			"type" => 'opened',
    			"description" => null,
    		],
    		"screen_resolution" => [
    			"type" => 'closed',
    			"description" => ["HVGA","WVGA","FWVGA","qHD","HD","FHD","QHD","QQVGA"],
    		],
    		"processor_speed" => [
    			"type" => 'opened',
    			"description" => null,
    		],
    		"number_of_cores" => [
    			"type" => 'closed',
    			"description" => ["1","2","3","4","8","10"],
    		],
    		"rear_camera" => [
    			"type" => 'closed',
    			"description" => ["1.3MP","2MP","5MP","8MP","12MP","13MP","16MP","VGA"],
    		],
    		"front_camera" => [
    			"type" => 'closed',
    			"description" => ["0.3MP","1.3MP","2MP","5MP","12MP","13MP","16MP"],
    		],
    		"battery" => [
    			"type" => 'opened',
    			"description" => null,
    		],
    		"3g_connectivity" => [
    			"type" => 'closed',
    			"description" => ["yes","no"],
    		],
    		"4g_connectivity" => [
    			"type" => 'closed',
    			"description" => ["yes","no"],
    		],
    		"fingerprint_reader" => [
    			"type" => 'closed',
    			"description" => ["yes","no"],
    		],
    		"ram" => [
    			"type" => 'closed',
    			"description" => ["512MB","1GB","2GB","3GB","4GB","6GB"],
    		],
            "rom" => [
                "type" => 'closed',
                "description" => ["4GB","8GB","16GB","32GB","64GB","128GB","256GB"],
            ],
            "sd_memory_capacity" => [
                "type" => 'closed',
                "description" => ["2GB","4GB","8GB","16GB","32GB","64GB","128GB"],
            ],
            "so" => [
                "type" => 'closed',
                "description" => [
                    "Android 1.5 Cupcake",
                    "Android 1.6 Donut",
                    "Android 2.0/2.1 Eclair",
                    "Android 2.2.x Froyo",
                    "Android 2.3.x Gingerbread",
                    "Android 3.x Honeycomb",
                    "Android 4.0.x Ice Cream Sandwich",
                    "Android 4.1 Jelly Bean",
                    "Android 4.2 Jelly Bean (Gummy Bear)",
                    "Android 4.3 Jelly Bean (Michel)",
                    "Android 4.4 KitKat (Dugger)",
                    "Android 5.0 Lollipop",
                    "Android 6.0 Marshmallow",
                    "Android 7.0 Nougat"
                ],
            ],
    	];

    	$devicesTranslation = [
    		"screen_size" 		 => ["es"=>"Tamaño de Pantalla", "en"=>"Screen Size"],
    		"screen_resolution"  => ["es"=>"Resolución de Pantalla", "en"=>"Screen Resolution"],
    		"processor_speed" 	 => ["es"=>"Velocidad del Procesador", "en"=>"Processor Speed"],
    		"number_of_cores" 	 => ["es"=>"Número de Núcleos", "en"=>"Number of Screen"],
    		"rear_camera" 		 => ["es"=>"Camara Trasera", "en"=>"Rear Camera"],
    		"front_camera" 		 => ["es"=>"Camara Frontal", "en"=>"Front Camera"],
    		"battery" 			 => ["es"=>"Bateria", "en"=>"Baterry"],
    		"3g_connectivity" 	 => ["es"=>"Conectividad 3G", "en"=>"3G Connectivity"],
    		"4g_connectivity" 	 => ["es"=>"Conectividad 4G", "en"=>"4G Connectivity"],
            "fingerprint_reader" => ["es"=>"Lector de Huellas", "en"=>"Fingerprint Reader"],
            "ram"                => ["es"=>"RAM", "en"=>"RAM"],
            "rom"                => ["es"=>"ROM", "en"=>"ROM"],
    		"sd_memory_capacity" => ["es"=>"Capacidad Memoria SD", "en"=>"SD Memory Capacity"],
            "so"                 => ["es"=>"Sistema Operativo", "en"=>"Operative System"],
    	];

        foreach ($devices as $key => $device) {
    		$id=DB::table('devices')->insertGetId([
    			'code' => $key,
    			'type' => $device['type'],
	            'description' => ($device['type'] == 'opened') ? $device['description'] : '["'.implode('","', array_filter($device['description'])).'"]',
	            'created_at' => date("Y-m-d H:i:s"),
	            'updated_at' => date("Y-m-d H:i:s")
	        ]);
	        if(isset($devicesTranslation[$key])){
	        	foreach ($devicesTranslation[$key] as $subKey => $subValue) {
		    		DB::table('devices_translations')->insert([
		    			'device_id' => $id,
		    			'name' => $subValue,
		    			'locale' => $subKey
			        ]);
	        	}
	        }
        }
    }
}