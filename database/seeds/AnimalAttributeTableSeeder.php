<?php

use Illuminate\Database\Seeder;

class AnimalAttributeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        App\AnimalAttribute::create([
            'animal_attributes_name' => 'น้ำหนัก',
            'animal_attributes_name_en' => 'weight',
            'animal_attributes_unit'=> 'kg'
        ]);

        App\AnimalAttribute::create([
            'animal_attributes_name' => 'ส่วนสูง',
            'animal_attributes_name_en' => 'height',
            'animal_attributes_unit'=> 'cm'
        ]);
        App\AnimalAttribute::create([
            'animal_attributes_name' => 'เพศ',
            'animal_attributes_name_en' => 'sex',
        ]);

        App\AnimalAttribute::create([
            'animal_attributes_name' => 'วันเกิด',
            'animal_attributes_name_en' => 'date of birth',
        ]);
    }
}
