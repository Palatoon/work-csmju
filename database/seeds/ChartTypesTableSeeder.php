<?php

use App\ChartType;
use Illuminate\Database\Seeder;

class ChartTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ChartType::create([
            'name' => 'Line',
        ]);
        ChartType::create([
            'name' => 'Bar',
        ]);
        ChartType::create([
            'name' => 'Pie',
        ]);
    }
}
