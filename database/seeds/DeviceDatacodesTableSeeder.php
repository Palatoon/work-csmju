<?php

use App\Datacode;
use App\Device;
use App\DeviceDatacode;
use Illuminate\Database\Seeder;

class DeviceDatacodesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Device::all() as $key => $value) {
            $dc = rand(1, 5);
            for ($i = 0; $i < $dc; $i++) {
                DeviceDatacode::create([
                    'device_id' => $value->id,
                    'datacode_id' => rand(1, 23)
                ]);
            }
        }
    }
}
