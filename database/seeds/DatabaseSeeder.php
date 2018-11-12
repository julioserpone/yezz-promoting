<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $this->call(ProfilesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(StoresTableSeeder::class);
        $this->call(DevicesTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(CountriesLimitedSeeder::class);   //Para limitar al sistema a que solo utilice los estados y ciudades donde hay presencia YEZZ
        $this->call(ProductsTableSeeder::class);
        Model::reguard();
    }
}
