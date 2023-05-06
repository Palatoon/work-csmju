<?php

use Illuminate\Database\Seeder;

class HistoryTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\HistoryType::create([
        
                'name' => 'การทำวัคซีน',
                'detail' => '',
                'type' => 'animal',
                'created_at' => now(),
                'updated_at' => now()
            ]);
            App\HistoryType::create([
            
                'name' => 'ถ่ายพยาธิ',
                'detail' => '',
                'type' => 'animal',
                'created_at' => now(),
                'updated_at' => now()
            ]);
            App\HistoryType::create([
            
                'name' => 'ป่วย/รักษา',
                'detail' => '',
                'type' => 'animal',
                'created_at' => now(),
                'updated_at' => now()
            ]);
            App\HistoryType::create([
            
                'name' => 'การผสมพันธุ์',
                'detail' => '',
                'type' => 'animal',
                'created_at' => now(),
                'updated_at' => now()
            ]);
            App\HistoryType::create([
            
                'name' => 'การคลอด',
                'detail' => '',
                'type' => 'animal',
                'created_at' => now(),
                'updated_at' => now()
            ]);
            App\HistoryType::create([
            
                'name' => 'ปริมาณการให้นมต่อวัน',
                'detail' => '',
                'type' => 'animal',
                'created_at' => now(),
                'updated_at' => now()
            ]);
            App\HistoryType::create([
            
                'name' => 'บันทึกน้ำหนัก/ส่วนสูง',
                'detail' => '',
                'type' => 'animal',
                'created_at' => now(),
                'updated_at' => now()
            ]);
            App\HistoryType::create([
            
                'name' => 'การให้ปุ๋ย',
                'detail' => '',
                'type' => 'plant',
                'created_at' => now(),
                'updated_at' => now()
            ]);
            App\HistoryType::create([
            
                'name' => 'การรักษาโรค',
                'detail' => '',
                'type' => 'plant',
                'created_at' => now(),
                'updated_at' => now()
            ]);
    }
}
