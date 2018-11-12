<?php

use App\TypeChannel;
use App\Chain;
use App\Branch;
use App\Country;
use App\State;
use App\City;
use App\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class StoresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$faker = Faker::create();

    	$typesId=[];
    	$types=[
    		'store'						=>["es"=>'Tienda', 			 	"en" => 'Store'],
    		'store_chain'				=>["es"=>'Cadena de Tienda', 	"en" => 'Store Chain'],
    		'dealers'					=>["es"=>'Distribuidores',   	"en" => 'Dealers'],
    		'e-commerce'				=>["es"=>'E-Commerce',   	 	"en" => 'E-Commerce'],
    		'government'				=>["es"=>'Gobierno',   		 	"en" => 'Government'],
    		'non-traditional_channel'	=>["es"=>'Canal No Tradicional',"en" => 'Non-Traditional Channel'],
    		'operator'					=>["es"=>'Operador',  	 		"en" => 'Operator'],
    	];

    	foreach ($types as $key => $value) {
    		$typesId[$key]=TypeChannel::create([
    			'code' => $key,
	            'en'   => ['name' => $value['en']],
	            'es'   => ['name' => $value['es']],
    		]);
    	}

    	$chains = [
    		["name" => "MONGE", "country" => "NI", "code" => "monge"],
    		["name" => "WALMART", "country" => "NI", "code" => "walmart"],
    		["name" => "COMTECH", "country" => "NI", "code" => "comtech"],
    		["name" => "J&M COMERCIAL", "country" => "NI", "code" => "jm-comercial"],
    		["name" => "WALMART", "country" => "NI", "code" => "walmart"],
    		["name" => "TELMOVIL", "country" => "NI", "code" => "telmovil"],
    		["name" => "EL MACHETAZO", "country" => "NI", "code" => "el-machetazo"],
    	];

    	$branchs = [
    		//////////////////////////// NICARAGUA //////////////////////////////////
			["name" => 'TIENDAS GALLO MÁS GALLO', "address"=>'Ciudad Sandino', "type" => 'store', "chain" => 'monge', "country" => 'NI', "city" => 'Managua'],
			["name" => 'TIENDAS GALLO MÁS GALLO', "address"=>'Matagalpa', "type" => 'store', "chain" => 'monge', "country" => 'NI', "city" => 'Matagalpa'],
			["name" => 'TIENDAS GALLO MÁS GALLO', "address"=>'Ciudad Jardin', "type" => 'store', "chain" => 'monge', "country" => 'NI', "city" => 'Managua'],
			["name" => 'TIENDAS GALLO MÁS GALLO', "address"=>'Bello Horizonte', "type" => 'store', "chain" => 'monge', "country" => 'NI', "city" => 'Managua'],
			["name" => 'TIENDAS GALLO MÁS GALLO', "address"=>'Plaza Inter', "type" => 'store', "chain" => 'monge', "country" => 'NI', "city" => 'Managua'],
			["name" => 'TIENDAS GALLO MÁS GALLO', "address"=>'Las Américas', "type" => 'store', "chain" => 'monge', "country" => 'NI', "city" => 'Managua'],
			["name" => 'TIENDAS GALLO MÁS GALLO', "address"=>'Tipitapa', "type" => 'store', "chain" => 'monge', "country" => 'NI', "city" => 'Managua'],
			["name" => 'TIENDAS GALLO MÁS GALLO', "address"=>'Huembes', "type" => 'store', "chain" => 'monge', "country" => 'NI', "city" => 'Managua'],
			["name" => 'TIENDAS GALLO MÁS GALLO', "address"=>'Multicentro Las Americas', "type" => 'store', "chain" => 'monge', "country" => 'NI', "city" => 'Managua'],
			["name" => 'TIENDAS GALLO MÁS GALLO', "address"=>'Boaco', "type" => 'store', "chain" => 'monge', "country" => 'NI', "city" => 'Boaco'],
			["name" => 'TIENDAS GALLO MÁS GALLO', "address"=>'Camoapa', "type" => 'store', "chain" => 'monge', "country" => 'NI', "city" => 'Boaco'],
			["name" => 'TIENDAS GALLO MÁS GALLO', "address"=>'Diriamba', "type" => 'store', "chain" => 'monge', "country" => 'NI', "city" => 'Diriamba'],
			["name" => 'TIENDAS GALLO MÁS GALLO', "address"=>'Jinotepe', "type" => 'store', "chain" => 'monge', "country" => 'NI', "city" => 'Jinotepe'],
			["name" => 'TIENDAS GALLO MÁS GALLO', "address"=>'Masatepe', "type" => 'store', "chain" => 'monge', "country" => 'NI', "city" => 'Masatepe'],
			["name" => 'TIENDAS GALLO MÁS GALLO', "address"=>'Chichigalpa', "type" => 'store', "chain" => 'monge', "country" => 'NI', "city" => 'Chinandega'],
			["name" => 'TIENDAS GALLO MÁS GALLO', "address"=>'Juigalpa', "type" => 'store', "chain" => 'monge', "country" => 'NI', "city" => 'Juigalpa'],
			["name" => 'TIENDAS GALLO MÁS GALLO', "address"=>'Esteli', "type" => 'store', "chain" => 'monge', "country" => 'NI', "city" => 'Esteli'],
			["name" => 'TIENDAS GALLO MÁS GALLO', "address"=>'Nandaime', "type" => 'store', "chain" => 'monge', "country" => 'NI', "city" => 'Granada'],
			["name" => 'TIENDAS GALLO MÁS GALLO', "address"=>'Granada', "type" => 'store', "chain" => 'monge', "country" => 'NI', "city" => 'Granada'],
			["name" => 'TIENDAS GALLO MÁS GALLO', "address"=>'Jinotega', "type" => 'store', "chain" => 'monge', "country" => 'NI', "city" => 'Jinotega'],
			["name" => 'TIENDAS GALLO MÁS GALLO', "address"=>'La Dalia', "type" => 'store', "chain" => 'monge', "country" => 'NI', "city" => 'Jinotega'],
			["name" => 'TIENDAS GALLO MÁS GALLO', "address"=>'El Viejo', "type" => 'store', "chain" => 'monge', "country" => 'NI', "city" => 'Leon'],
			["name" => 'TIENDAS GALLO MÁS GALLO', "address"=>'Leon', "type" => 'store', "chain" => 'monge', "country" => 'NI', "city" => 'Leon'],
			
			["name" => 'TIENDAS EL VERDUGO', "address"=>'Ciudad Jardin', "type" => 'store', "chain" => 'monge', "country" => 'NI', "city" => 'Managua'],
			["name" => 'TIENDAS EL VERDUGO', "address"=>'Las Americas', "type" => 'store', "chain" => 'monge', "country" => 'NI', "city" => 'Managua'],
			["name" => 'TIENDAS EL VERDUGO', "address"=>'Tipitapa', "type" => 'store', "chain" => 'monge', "country" => 'NI', "city" => 'Managua'],
			["name" => 'TIENDAS EL VERDUGO', "address"=>'La Granvia', "type" => 'store', "chain" => 'monge', "country" => 'NI', "city" => 'Managua'],
			["name" => 'TIENDAS EL VERDUGO', "address"=>'Boaco', "type" => 'store', "chain" => 'monge', "country" => 'NI', "city" => 'Boaco'],
			["name" => 'TIENDAS EL VERDUGO', "address"=>'Jinotepe', "type" => 'store', "chain" => 'monge', "country" => 'NI', "city" => 'Jinotepe'],
			["name" => 'TIENDAS EL VERDUGO', "address"=>'Chinandega', "type" => 'store', "chain" => 'monge', "country" => 'NI', "city" => 'Chinandega'],
			["name" => 'TIENDAS EL VERDUGO', "address"=>'Juigalpa', "type" => 'store', "chain" => 'monge', "country" => 'NI', "city" => 'Juigalpa'],
			["name" => 'TIENDAS EL VERDUGO', "address"=>'Esteli', "type" => 'store', "chain" => 'monge', "country" => 'NI', "city" => 'Esteli'],
			["name" => 'TIENDAS EL VERDUGO', "address"=>'Granada', "type" => 'store', "chain" => 'monge', "country" => 'NI', "city" => 'Granada'],
			["name" => 'TIENDAS EL VERDUGO', "address"=>'Jinotega', "type" => 'store', "chain" => 'monge', "country" => 'NI', "city" => 'Jinotega'],
			["name" => 'TIENDAS EL VERDUGO', "address"=>'Leon', "type" => 'store', "chain" => 'monge', "country" => 'NI', "city" => 'Leon'],

			["name" => 'TELMOVIL', "address"=>'Plaza La Sabana', "type" => 'store', "chain" => 'telmovil', "country" => 'NI', "city" => 'Managua'],
			["name" => 'COMTECH', "address"=>'Altamira', "type" => 'store', "chain" => 'comtech', "country" => 'NI', "city" => 'Managua'],
			["name" => 'MOVISTAR CAP Agente  Autorizado Nagarote', "address"=>'Del parque central 2c abajo 1/2 cuadra al sur', "type" => 'operator', "chain" => null, "country" => 'NI', "city" => 'Leon'],

			["name" => 'MAXI PALI', "address"=>'Waspan', "type" => 'store', "chain" => 'walmart', "country" => 'NI', "city" => 'Managua'],
			["name" => 'MAXI PALI', "address"=>'Oriental', "type" => 'store', "chain" => 'walmart', "country" => 'NI', "city" => 'Managua'],
			["name" => 'MAXI PALI', "address"=>'Esteli', "type" => 'store', "chain" => 'walmart', "country" => 'NI', "city" => 'Esteli'],

			["name" => 'J&M COMERCIAL', "address"=>'Plaza Inter', "type" => 'store', "chain" => 'jm-comercial', "country" => 'NI', "city" => 'Managua'],
			["name" => 'J&M COMERCIAL', "address"=>'Colonia 1ero de Marzo', "type" => 'store', "chain" => 'jm-comercial', "country" => 'NI', "city" => 'Managua'],
			["name" => 'J&M COMERCIAL', "address"=>'Multicentro Las Americas', "type" => 'store', "chain" => 'jm-comercial', "country" => 'NI', "city" => 'Managua'],
			["name" => 'J&M COMERCIAL', "address"=>'Chinandega (Chichigalpa)', "type" => 'store', "chain" => 'jm-comercial', "country" => 'NI', "city" => 'Chinandega'],
			["name" => 'J&M COMERCIAL', "address"=>'Chinandega (Somotillo)', "type" => 'store', "chain" => 'jm-comercial', "country" => 'NI', "city" => 'Chinandega'],
			["name" => 'J&M COMERCIAL', "address"=>'Esteli (Somoto)', "type" => 'store', "chain" => 'jm-comercial', "country" => 'NI', "city" => 'Esteli'],

			//////////////////////////// PANAMA //////////////////////////////////
			["name" => 'MACHETAZO DE CALIDONIA', "address"=>'CALIDONIA CON AV PERÚ 507, PANAMÁ', "type" => 'store', "chain" => 'el-machetazo', "country" => 'PA', "city" => 'Panama'],
			["name" => 'MACHETAZO SAN MIGUELITO', "address"=>'SAN MIGUELITO, VICTORIANO LORENZO, PANAMÁ', "type" => 'store', "chain" => 'el-machetazo', "country" => 'PA', "city" => 'Panama'],
			["name" => 'MACHETAZO  (COSTA SUR)', "address"=>'URB. COSTA SUR, CC COSTA SUR, PANAMÁ', "type" => 'store', "chain" => 'el-machetazo', "country" => 'PA', "city" => 'Panama'],
			["name" => 'MACHETAZO (METROMALL)', "address"=>'AV DOMINGO DÍAZ, CC METROMALL, PANAMÁ', "type" => 'store', "chain" => 'el-machetazo', "country" => 'PA', "city" => 'Panama'],
			["name" => 'MACHETAZO (TOCUMEN)', "address"=>'VÍA PANAMERICÁNA, URB 24 DE DICIEMBRE, PANAMÁ', "type" => 'store', "chain" => 'el-machetazo', "country" => 'PA', "city" => 'Panama'],

			["name" => 'LUPY CELL', "address"=>'AV CENTRAL, PANAMÁ', "type" => 'store', "chain" => null, "country" => 'PA', "city" => 'Panama'],
			["name" => 'CELULARES MC', "address"=>'AV CENTRAL, PANAMÁ', "type" => 'store', "chain" => null, "country" => 'PA', "city" => 'Panama'],
			["name" => 'CENTRO MOVIL PANAMA', "address"=>'AV CENTRAL, PANAMÁ', "type" => 'store', "chain" => null, "country" => 'PA', "city" => 'Panama'],
			["name" => 'ALMACEN STEPHY', "address"=>'AV CENTRAL, PANAMÁ', "type" => 'store', "chain" => null, "country" => 'PA', "city" => 'Panama'],
			["name" => 'PERFUME FAMOUS', "address"=>'CALIDONIA, PANAMÁ', "type" => 'store', "chain" => null, "country" => 'PA', "city" => 'Panama'],
			["name" => 'ALMACEN PROGRESO', "address"=>'CALIDONIA, PANAMÁ', "type" => 'store', "chain" => null, "country" => 'PA', "city" => 'Panama'],
			["name" => 'MULTICELL WANG', "address"=>'CALIDONIA, PANAMÁ', "type" => 'store', "chain" => null, "country" => 'PA', "city" => 'Panama'],
			["name" => 'CELULARES WIN', "address"=>'CALIDONIA, PANAMÁ', "type" => 'store', "chain" => null, "country" => 'PA', "city" => 'Panama'],
			["name" => 'E MULTI STORE', "address"=>'CALIDONIA, PANAMÁ', "type" => 'store', "chain" => null, "country" => 'PA', "city" => 'Panama'],
			["name" => 'MOVIL CENTER', "address"=>'CALIDONIA, PANAMÁ', "type" => 'store', "chain" => null, "country" => 'PA', "city" => 'Panama'],
			["name" => 'LINK TECH', "address"=>'CC EL DORADO , AV. TUMBA MUERTOS, EL DORADO, PANAMÁ', "type" => 'store', "chain" => null, "country" => 'PA', "city" => 'Panama'],
			["name" => 'CITY PLAYER', "address"=>'CC EL DORADO , AV. TUMBA MUERTOS, EL DORADO, PANAMÁ', "type" => 'store', "chain" => null, "country" => 'PA', "city" => 'Panama'],
			["name" => 'MOVIL SOL', "address"=>'LOS PUEBLOS, AV DOMINGO DÍAZ, PANAMÁ CITY', "type" => 'store', "chain" => null, "country" => 'PA', "city" => 'Panama'],
			["name" => 'MAX STORE', "address"=>'CC LA DOÑA, CARRETERA PANAMERICANA, PANAMÁ', "type" => 'store', "chain" => null, "country" => 'PA', "city" => 'Panama'],
			["name" => 'YAYO ALTA PLAZA', "address"=>'CC ALTA PLAZA, VÍA CENTENARIO, PANAMÁ', "type" => 'store', "chain" => null, "country" => 'PA', "city" => 'Panama'],
			["name" => 'CELL PLUS', "address"=>'CC EL DORADO , AV. TUMBA MUERTOS, EL DORADO, PANAMÁ', "type" => 'store', "chain" => null, "country" => 'PA', "city" => 'Panama'],
			["name" => 'DRAGON CELL', "address"=>'CC EL DORADO , AV. TUMBA MUERTOS, EL DORADO, PANAMÁ', "type" => 'store', "chain" => null, "country" => 'PA', "city" => 'Panama'],
			["name" => 'POWER PHONE', "address"=>'CC EL DORADO , AV. TUMBA MUERTOS, EL DORADO, PANAMÁ', "type" => 'store', "chain" => null, "country" => 'PA', "city" => 'Panama'],
			["name" => 'SUPER PRECIO CELULAR', "address"=>'CC EL DORADO , AV. TUMBA MUERTOS, EL DORADO, PANAMÁ', "type" => 'store', "chain" => null, "country" => 'PA', "city" => 'Panama'],
			["name" => 'GIGA', "address"=>'CC ALBROOK, AV. ROOSEVELT , AL LADO GRAN TERMINAL TRANSP, PANAMÁ', "type" => 'store', "chain" => null, "country" => 'PA', "city" => 'Panama'],
			["name" => 'ZONA TECNO', "address"=>'CC ALBROOK, AV. ROOSEVELT , AL LADO GRAN TERMINAL TRANSP, PANAMÁ', "type" => 'store', "chain" => null, "country" => 'PA', "city" => 'Panama'],
			["name" => 'CELLMAX', "address"=>'PLAZA EDINSON, AV. RICARDO J. ALFARO, PANAMÁ', "type" => 'store', "chain" => null, "country" => 'PA', "city" => 'Panama'],
			["name" => 'RAENCO (TRANSISTMICA)', "address"=>'TRANSISTMICA, PANAMÁ', "type" => 'store', "chain" => null, "country" => 'PA', "city" => 'Panama'],
			["name" => 'LUNA CELL', "address"=>'LOS ANDES, TRANSISTMICA, SAN MIGUELITO, PANAMÁ', "type" => 'store', "chain" => null, "country" => 'PA', "city" => 'Panama'],
			["name" => 'SUNS MOBILE', "address"=>'LOS ANDES, TRANSISTMICA, SAN MIGUELITO, PANAMÁ', "type" => 'store', "chain" => null, "country" => 'PA', "city" => 'Panama'],
			["name" => 'GLOBAL MOBILE NET', "address"=>'LOS ANDES, TRANSISTMICA, SAN MIGUELITO, PANAMÁ', "type" => 'store', "chain" => null, "country" => 'PA', "city" => 'Panama'],
			["name" => 'TOP MOBILE CENTER', "address"=>'LOS ANDES, TRANSISTMICA, SAN MIGUELITO, PANAMÁ', "type" => 'store', "chain" => null, "country" => 'PA', "city" => 'Panama'],
			["name" => 'BEAUTY CELL', "address"=>'LOS ANDES, TRANSISTMICA, SAN MIGUELITO, PANAMÁ', "type" => 'store', "chain" => null, "country" => 'PA', "city" => 'Panama'],
			["name" => 'FASHION', "address"=>'LOS ANDES, TRANSISTMICA, SAN MIGUELITO, PANAMÁ', "type" => 'store', "chain" => null, "country" => 'PA', "city" => 'Panama'],
			["name" => 'MAS CELL', "address"=>'LOS ANDES, TRANSISTMICA, SAN MIGUELITO, PANAMÁ', "type" => 'store', "chain" => null, "country" => 'PA', "city" => 'Panama'],
			["name" => 'TECHNO CELL & COMPUTER', "address"=>'LOS ANDES, TRANSISTMICA, SAN MIGUELITO, PANAMÁ', "type" => 'store', "chain" => null, "country" => 'PA', "city" => 'Panama'],
			["name" => 'YAYO ELECTRONIC', "address"=>'CC. MULTICENTRO , AV. BALBOA, PANAMÁ CITY', "type" => 'store', "chain" => null, "country" => 'PA', "city" => 'Panama'],
			["name" => 'G&J SOLUTIONS', "address"=>'CC LA DOÑA, CARRETERA PANAMERICANA, PANAMÁ', "type" => 'store', "chain" => null, "country" => 'PA', "city" => 'Panama'],
			["name" => 'MEGA SMARTPHONE & INTERNET', "address"=>'CC MEGAMALL, CARRETERA PANAMERICANA, PANAMÁ', "type" => 'store', "chain" => null, "country" => 'PA', "city" => 'Panama'],
			["name" => 'YO ITALK', "address"=>'CC MEGAMALL, CARRETERA PANAMERICANA, PANAMÁ', "type" => 'store', "chain" => null, "country" => 'PA', "city" => 'Panama'],
			["name" => 'RAENCO (COSTA SUR)', "address"=>'MANGLARES Y HUMEDADES DE LA BAHÍA, PANAMÁ', "type" => 'store', "chain" => null, "country" => 'PA', "city" => 'Panama'],
			["name" => 'MOBILE CENTER', "address"=>'LOS PUEBLOS, AV DOMINGO DÍAZ, PANAMÁ CITY', "type" => 'store', "chain" => null, "country" => 'PA', "city" => 'Panama'],
			["name" => 'RAENCO (LOS PUEBLOS)', "address"=>'CALLE C, PANAMÁ', "type" => 'store', "chain" => null, "country" => 'PA', "city" => 'Panama'],
		];

    	$admin = User::where('username', 'admin')->first();
    	foreach ($chains as $chain) {
    		$chainsId[$chain["code"]] = 
    			Chain::create([
    				'chain_user_id' => $admin->id,
    				'chain_country_id' => (isset($chain['country'])) ? Country::where('sortname',$chain['country'])->first()->id : null,
    				'identification_chain' => $chain['code'],
    				'name_chain' => $chain['name'],
    				'address_chain' => $faker->streetAddress,
    				'phone_chain' => $faker->phoneNumber,
    				'email_chain' => $faker->unique()->email,
    			]);
    	}

    	$i=0;
    	foreach ($branchs as $branch) {
    		$country = (isset($branch['country'])) ? Country::where('sortname',$branch['country'])->first() : null;
    		$state = ($country) ? State::select(['id'])->where('country_id', $country->id)->get()->toArray() : null;
    		$city = (isset($branch['city'])) ? City::where('name',$branch['city'])->whereIn('state_id', $state)->first() : null;
    		$type_channel = (isset($branch['type'])) ? TypeChannel::where('code',$branch['type'])->first() : null;
    		Branch::create([
    			'name' => $branch['name'],
    			'code' => "S-".($i++),
    			'address' => $branch['address'],
    			'chain_id' => (isset($branch['chain'])) ? $chainsId[$branch['chain']]->first()->id : null,
    			'country_id' => ($country) ? $country->id : null,
    			'state_id' => ($city) ? $city->state_id : null,
    			'city_id' => ($city) ? $city->id : null,
    			'type_id' => ($type_channel) ? $type_channel->id : null,
    		]);
    	}
    }
}




