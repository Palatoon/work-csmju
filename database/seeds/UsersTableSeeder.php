<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = \App\Role::where('slug', 'super-admin')->first();
        $admin = new \App\User();
        $admin->name = 'lannacom';
        $admin->username = 'admin';
        $admin->email = 'admin';
        $admin->password = bcrypt('Lannacom@1');
        $admin->remember_token = Str::random(10);
        $admin->save();
        $admin->roles()->attach($role);
    }
}
