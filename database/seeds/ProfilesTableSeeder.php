<?php

use Illuminate\Database\Seeder;

class ProfilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $profiles = [
            ["code" => "trademarketing", "name" => "Trademarketing y Ventas"],
            ["code" => "leader_agency", "name" => "Líder de agencia"],
            ["code" => "leader_pdv", "name" => "Líder PDV"],
            ["code" => "seller", "name" => "Vendedor PDV"],
            ["code" => "promotor", "name" => "Promotor"],
            ["code" => "administrator", "name" => "Administrator"],
        ];

        foreach ($profiles as $row) {
            DB::table('profiles')->insert([
                'code' => $row["code"],
                'name' => $row["name"],
                'permissions' => '',
            ]);
        }
    }
}
