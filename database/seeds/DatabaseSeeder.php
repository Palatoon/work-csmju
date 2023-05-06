<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AnimalAttributeTableSeeder::class);
        $this->call(AnimalTypeTableSeeder::class);
        $this->call(AnimalTableSeeder::class);
        // $this->call(ChartTypesTableSeeder::class);
        $this->call(DataCodesTableSeeder::class);
        $this->call(HoursTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(ConfigurationTableSeeder::class);
        $this->call(BuildingsTableSeeder::class);
        $this->call(AreasTableSeeder::class);
        $this->call(RoomTypesTableSeeder::class);
        $this->call(RoomsTableSeeder::class);
        $this->call(DeviceTypesTableSeeder::class);
        $this->call(DeviceTypeStatusesTableSeeder::class);
        $this->call(DevicesTableSeeder::class);
        $this->call(ConditionListsTableSeeder::class);
        $this->call(CommandsTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        // $this->call(DeviceDatacodesTableSeeder::class);
    }
}
