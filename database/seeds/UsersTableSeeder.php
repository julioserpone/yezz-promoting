<?php

use Illuminate\Database\Seeder;

use App\User;
use App\UserSector;
use App\ContactData;
use App\Profile;
use App\Country;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $des="Description Profile Here";

		$faker = Faker::create();

        $users = [
            [
                'profile' => 'seller', 
                'email' => 'aalvins@grupocelpa.com', 
                'username' => 'aalvins', 
                'gender' => 'male', 
                'country' => 'PA', 
                'first_name' => 'Allan', 
                'last_name' => 'Alvins',
                'contact_data' => [
                    ['data'=>'aalvins@grupocelpa.com','type'=>'email','origin'=>'user'],
                    ['data'=>'aalvins@grupocelpa.com','type'=>'facebook','origin'=>'user'],
                    ['data'=>'+507 6447 0180','type'=>'mobilePhoneNumber','origin'=>'user'],
                ],
            ],
            [
                'profile' => 'administrator', 
                'email' => 'hguevara@yezzcorp.com', 
                'username' => 'hguevara', 
                'gender' => 'male', 
                'country' => 'PA', 
                'first_name' => 'Henry', 
                'last_name' => 'Guevara',
                'contact_data' => [
                    ['data'=>'hguevara@yezzcorp.com','type'=>'email','origin'=>'user'],
                    ['data'=>'hguevara@yezzcorp.com','type'=>'facebook','origin'=>'user'],
                    ['data'=>'+58 412 8849805','type'=>'mobilePhoneNumber','origin'=>'user'],
                ],
            ],
            [
                'profile' => 'administrator', 
                'email' => 'juliohernandezs@gmail.com', 
                'username' => 'admin', 
                'gender' => 'male', 
                'country' => 'VE', 
                'first_name' => 'Julio', 
                'last_name' => 'Hernandez',
                'contact_data' => [
                    ['data'=>'juliohernandezs@gmail.com','type'=>'email','origin'=>'user'],
                    ['data'=>'+58 424 4323883','type'=>'mobilePhoneNumber','origin'=>'user'],
                ],
            ],
            [
                'profile' => 'trademarketing', 
                'email' => 'jlzreik@akkarg.com', 
                'username' => 'jlzreik', 
                'gender' => 'male', 
                'country' => 'CO', 
                'first_name' => 'Jose Luis', 
                'last_name' => 'Zreik',
                'contact_data' => [
                    ['data'=>'jlzreik@akkarg.com','type'=>'email','origin'=>'user'],
                    ['data'=>'jlzreik@akkarg.com','type'=>'facebook','origin'=>'user'],
                    ['data'=>'+58 1 123456789','type'=>'mobilePhoneNumber','origin'=>'user'],
                ],
            ],
            [
                'profile' => 'trademarketing', 
                'email' => 'jcoronado@yezzcorp.com', 
                'username' => 'jcoronado', 
                'gender' => 'male', 
                'country' => 'CO', 
                'first_name' => 'Jonas', 
                'last_name' => 'Coronado',
                'contact_data' => [
                    ['data'=>'jcoronado@yezzcorp.com','type'=>'email','origin'=>'user'],
                    ['data'=>'+58 414 5829191','type'=>'mobilePhoneNumber','origin'=>'user'],
                ],
            ],
            [
                'profile' => 'trademarketing', 
                'email' => 'arumbos@yezzcorp.com', 
                'username' => 'arumbos', 
                'gender' => 'female', 
                'country' => 'PA', 
                'first_name' => 'Angélica', 
                'last_name' => 'Rumbos',
                'contact_data' => [
                    ['data'=>'arumbos@yezzcorp.com','type'=>'email','origin'=>'user'],
                    ['data'=>'+58 414 3585013','type'=>'mobilePhoneNumber','origin'=>'user'],
                ],
            ],
        ];

        //Usuarios precargados
        foreach ($users as $user) {
            $country = Country::where('sortname',$user['country'])->first();
            $new=User::create([
                'profile_id' => Profile::select(['id'])->where('code', $user['profile'])->first()->id,
                'username' => $user['username'],
                'email' => $user['email'],
                'password' => \Hash::make('123456'),
                'country_id' => $country->id,
                'person' => [
                    'identity_code' => $faker->unique()->numberBetween(1, 999999999),
                    'first_name' => $user['first_name'],
                    'last_name' => $user['last_name'],
                    'birthdate' => $faker->dateTimeBetween('-40 years', '-16 years'),
                    'pic_url' => 'img/profile/avatar.png',
                    'gender' => $user['gender'],
                    'language' => 'en',
                    'country_id' => $country->id,
                    'description' =>  $des,
                    'address' => $faker->streetAddress,
                ],
            ]);

            //Contact Data
            foreach ($user['contact_data'] as $row) {
                $row['source_id']=$new->id;
                ContactData::create($row);
            }

            //Regionalizacion de  usuarios (solo paises, para pruebas)
            UserSector::create([
                'user_id' => $new->id,
                'country_id' => $country->id
            ]);
        }
        
        for ($i = 0; $i < 20; $i++) {
            $first_name = $faker->unique()->firstName;
            $last_name = $faker->unique()->lastName;
            $country = Country::where('sortname',"VE")->first();
            $new = User::create([
                'profile_id' => Profile::select(['id'])->orderByRaw('RAND()')->first()->id,
                'username' => substr($first_name, 1, 1).strtolower($last_name),
                'email' => $faker->unique()->email,
                'password' =>  \Hash::make('123456'),
                'country_id' =>  $country->id,
                'person' => [
                    'identity_code' => $faker->unique()->numberBetween(1, 999999999),
                    'first_name' => $faker->unique()->firstName,
                    'last_name' => $faker->unique()->lastName,
                    'birthdate' => $faker->dateTimeBetween('-40 years', '-16 years'),
                    'pic_url' => 'img/profile/avatar' . $faker->numberBetween(1, 6) . '.png',
                    'gender' => $faker->randomElement(array_keys(trans('globals.gender'))),
                    'country_id' => $country->id,
                	'description' =>  $des.$des,
                    'language' => $faker->randomElement(array_keys(trans('globals.language'))),
                    'address' => $faker->streetAddress,
                ],
            ]);

            //Regionalizacion de  usuarios (solo paises, para pruebas)
            UserSector::create([
                'user_id' => $new->id,
                'country_id' => $country->id
            ]);
        }
    }
}
