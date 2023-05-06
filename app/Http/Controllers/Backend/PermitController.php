<?php

namespace App\Http\Controllers\Backend;

use App\Permit;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;

class PermitController extends Controller
{

    // public function Permit()
    // {
    //     $dev_permit = Permit::where('slug', 'create-tasks')->first();
    //     $manager_permit = Permit::where('slug', 'edit-users')->first();

    //     //RoleTableSeeder.php
    //     $dev_role = new Role();
    //     $dev_role->slug = 'developer';
    //     $dev_role->name = 'Front-end Developer';
    //     $dev_role->save();
    //     $dev_role->permits()->attach($dev_permit);

    //     $manager_role = new Role();
    //     $manager_role->slug = 'manager';
    //     $manager_role->name = 'Assistant Manager';
    //     $manager_role->save();
    //     $manager_role->permits()->attach($manager_permit);

    //     $dev_role = Role::where('slug', 'developer')->first();
    //     $manager_role = Role::where('slug', 'manager')->first();

    //     $createTasks = new Permit();
    //     $createTasks->slug = 'create-tasks';
    //     $createTasks->name = 'Create Tasks';
    //     $createTasks->save();
    //     $createTasks->roles()->attach($dev_role);

    //     $editUsers = new Permit();
    //     $editUsers->slug = 'edit-users';
    //     $editUsers->name = 'Edit Users';
    //     $editUsers->save();
    //     $editUsers->roles()->attach($manager_role);

    //     $dev_role = Role::where('slug', 'developer')->first();
    //     $manager_role = Role::where('slug', 'manager')->first();
    //     $dev_perm = Permit::where('slug', 'create-tasks')->first();
    //     $manager_perm = Permit::where('slug', 'edit-users')->first();

    //     $developer = new User();
    //     $developer->name = 'Mahedi Hasan';
    //     $developer->username = 'MahediHasan';
    //     $developer->email = 'mahedi@gmail.com';
    //     $developer->password = bcrypt('secrettt');
    //     $developer->save();
    //     $developer->roles()->attach($dev_role);
    //     $developer->permits()->attach($dev_perm);

    //     $manager = new User();
    //     $manager->name = 'Hafizul Islam';
    //     $manager->username = 'HafizulIslam';
    //     $manager->email = 'hafiz@gmail.com';
    //     $manager->password = bcrypt('secrettt');
    //     $manager->save();
    //     $manager->roles()->attach($manager_role);
    //     $manager->permits()->attach($manager_perm);


    //     return redirect()->back();
    // }
}
