<?php

use Illuminate\Database\Seeder;

use App\Country;
use App\State;
use App\City;

use Faker\Factory as Faker;

class CountriesLimitedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Rutina para eliminar los estados y ciudades de los paises que no vamos a utilizar
        $countries = Country::select(['id'])->whereIn('sortname', trans('globals.countries_yezz'))->get();
        $states_to_delete = State::select(['id'])->whereNotIn('country_id', $countries)->get();
        $cities_deleted = City::whereIn('state_id', $states_to_delete)->forceDelete();
        State::whereNotIn('country_id', $countries)->forceDelete();
        Country::whereNotIn('sortname', trans('globals.countries_yezz'))->forceDelete();
    }
}
