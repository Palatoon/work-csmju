<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = array(
            0 => array(
                'template_id' => 1,
                'name' => 'Facescan Users Flr.2',
                'address' => 'CN=Facescan Users Flr.2,OU=System,OU=Groups,OU=Organization,DC=lanna,DC=co,DC=th',
                'type' => 'Access Control',
                'hours' => 0,
                'room_id' => 2,

            ),
            1 => array(
                'template_id' => 1,
                'name' => 'Facescan Users Flr.1',
                'address' => 'CN=Facescan Users Flr.1,OU=System,OU=Groups,OU=Organization,DC=lanna,DC=co,DC=th',
                'type' => 'Access Control',
                'hours' => 0,
                'room_id' => 1,

            ),
            2 => array(
                'template_id' => 1,
                'name' => 'Facescan Users Flr.2',
                'address' => 'CN=Facescan Users Flr.2,OU=System,OU=Groups,OU=Organization,DC=lanna,DC=co,DC=th',
                'type' => 'Access Control',
                'hours' => 0,
                'room_id' => 1,

            ),
            3 => array(
                'template_id' => 1,
                'name' => 'Facescan Users Flr.2',
                'address' => 'CN=Facescan Users Flr.2,OU=System,OU=Groups,OU=Organization,DC=lanna,DC=co,DC=th',
                'type' => 'Camera',
                'hours' => 0,
                'room_id' => 3,

            ),
        );

        foreach ($permissions as $key => $value) {
            App\Permission::create($value);
        }
    }
}
