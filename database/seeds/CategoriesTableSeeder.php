<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ["name" => "categoria A", "description" => "Muchas ventas, alto trafico de gente", "status" => 1],
            ["name" => "categoria B", "description" => "Medianas ventas, mediano trafico de gente", "status" => 1],
            ["name" => "categoria C", "description" => "Pocas ventas, poco tráfico de gente", "status" => 1],
        ];

        foreach ($categories as $row) {
            DB::table('categories')->insert([
                'name' => $row["name"],
                'description' => $row["description"],
                'status' => $row['status'],
            ]);
        }
    }
}
