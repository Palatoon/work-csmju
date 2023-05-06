<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DataCodesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            0 => array('DataCode' => 'CO', 'DataLabel' => 'CO', 'DataUnit' => 'ppm', 'SmallCode' => 'CO'),
            1 => array('DataCode' => 'CO2', 'DataLabel' => 'CO2', 'DataUnit' => 'ppm', 'SmallCode' => 'CO2'),
            2 => array('DataCode' => 'EH10001', 'DataLabel' => 'Humidity', 'DataUnit' => '%', 'SmallCode' => 'EH1'),
            3 => array('DataCode' => 'ELECI1', 'DataLabel' => 'Current Phase-1', 'DataUnit' => 'A', 'SmallCode' => 'A1'),
            4 => array('DataCode' => 'ELECI2', 'DataLabel' => 'Current Phase-2', 'DataUnit' => 'A', 'SmallCode' => 'A2'),
            5 => array('DataCode' => 'ELECI3', 'DataLabel' => 'Current Phase-3', 'DataUnit' => 'A', 'SmallCode' => 'A3'),
            6 => array('DataCode' => 'ELECP1', 'DataLabel' => 'Power Phase-1', 'DataUnit' => 'kW', 'SmallCode' => 'P1'),
            7 => array('DataCode' => 'ELECP2', 'DataLabel' => 'Power Phase-2', 'DataUnit' => 'kW', 'SmallCode' => 'P2'),
            8 => array('DataCode' => 'ELECP3', 'DataLabel' => 'Power Phase-3', 'DataUnit' => 'kW', 'SmallCode' => 'P3'),
            9 => array('DataCode' => 'ELECU', 'DataLabel' => 'Unit', 'DataUnit' => 'Unit', 'SmallCode' => 'E'),
            10 => array('DataCode' => 'ELECV1', 'DataLabel' => 'Volt Phase-1', 'DataUnit' => 'V', 'SmallCode' => 'V1'),
            11 => array('DataCode' => 'ELECV2', 'DataLabel' => 'Volt Phase-2', 'DataUnit' => 'V', 'SmallCode' => 'V2'),
            12 => array('DataCode' => 'ELECV3', 'DataLabel' => 'Volt Phase-3', 'DataUnit' => 'V', 'SmallCode' => 'V3'),
            13 => array('DataCode' => 'ELECVAB', 'DataLabel' => 'Volt Phase-1+2', 'DataUnit' => 'V', 'SmallCode' => 'VAB'),
            14 => array('DataCode' => 'ELECVBC', 'DataLabel' => 'Volt Phase-2+3', 'DataUnit' => 'V', 'SmallCode' => 'VBC'),
            15 => array('DataCode' => 'ELECVCA', 'DataLabel' => 'Volt Phase-3+1', 'DataUnit' => 'V', 'SmallCode' => 'VCA'),
            16 => array('DataCode' => 'ET10001', 'DataLabel' => 'Temperature', 'DataUnit' => 'C', 'SmallCode' => 'ET1'),
            17 => array('DataCode' => 'H2S', 'DataLabel' => 'Hydrogen Sulfide Gas', 'DataUnit' => 'ppm', 'SmallCode' => 'H2S'),
            18 => array('DataCode' => 'LLT0001', 'DataLabel' => 'Lighting Level', 'DataUnit' => 'LUX', 'SmallCode' => 'LLT'),
            19 => array('DataCode' => 'LUV0001', 'DataLabel' => 'UV Level', 'DataUnit' => 'Level', 'SmallCode' => 'LUV'),
            20 => array('DataCode' => 'Met', 'DataLabel' => 'Methen', 'DataUnit' => 'ppm', 'SmallCode' => 'Met'),
            21 => array('DataCode' => 'WRn0001', 'DataLabel' => 'Rian Gage', 'DataUnit' => 'Times', 'SmallCode' => 'WRn'),
            22 => array('DataCode' => 'WWD0001', 'DataLabel' => 'Wind Direction', 'DataUnit' => 'Degree', 'SmallCode' => 'WWD'),
            23 => array('DataCode' => 'WWS0001', 'DataLabel' => 'Wind Speed', 'DataUnit' => 'm/s', 'SmallCode' => 'WWS'),
        );

        foreach ($data as $key => $value) {
            DB::table('DataCode')->insert([
                'DataCode' => $value['DataCode'],
                'DataLabel' => $value['DataLabel'],
                'DataUnit' => $value['DataUnit'],
                'SmallCode' => $value['SmallCode'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
