<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $super_admin_role = new App\Role();
        $super_admin_role->slug = 'super-admin';
        $super_admin_role->name = 'Super Admin';
        $super_admin_role->save();

        $admin_role = new App\Role();
        $admin_role->slug = 'admin';
        $admin_role->name = 'Admin';
        $admin_role->save();

        $user_role = new App\Role();
        $user_role->slug = 'user';
        $user_role->name = 'Normal User';
        $user_role->save();

        $super_admin = App\Role::where('slug', 'super-admin')->first();
        $admin = App\Role::where('slug', 'admin')->first();
        $user = App\Role::where('slug', 'user')->first();

        $manageUsers = new App\Permit();
        $manageUsers->slug = 'manage-users';
        $manageUsers->name = 'Manage Users';
        $manageUsers->save();
        $manageUsers->roles()->attach($super_admin);

        $manageSettings = new App\Permit();
        $manageSettings->slug = 'manage-settings';
        $manageSettings->name = 'Manage Settings';
        $manageSettings->save();
        $manageSettings->roles()->attach($super_admin);

        $manageBuildings = new App\Permit();
        $manageBuildings->slug = 'manage-farms';
        $manageBuildings->name = 'Manage Farms';
        $manageBuildings->save();
        $manageBuildings->roles()->attach($super_admin);

        $manageAreas = new App\Permit();
        $manageAreas->slug = 'manage-areas';
        $manageAreas->name = 'Manage Areas';
        $manageAreas->save();
        $manageAreas->roles()->attach($super_admin);

        $manageRooms = new App\Permit();
        $manageRooms->slug = 'manage-houses';
        $manageRooms->name = 'Manage Houses';
        $manageRooms->save();
        $manageRooms->roles()->attach($super_admin);
        $manageRooms->roles()->attach($admin);

        $manageRequests = new App\Permit();
        $manageRequests->slug = 'manage-requests';
        $manageRequests->name = 'Manage Requests';
        $manageRequests->save();
        $manageRequests->roles()->attach($super_admin);
        $manageRequests->roles()->attach($admin);

        $canbookings = new App\Permit();
        $canbookings->slug = 'bookings';
        $canbookings->name = 'Bookings';
        $canbookings->save();
        $canbookings->roles()->attach($super_admin);
        $canbookings->roles()->attach($admin);
        $canbookings->roles()->attach($user);

    }
}
