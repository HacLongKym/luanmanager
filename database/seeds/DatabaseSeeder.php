<?php

use Illuminate\Database\Seeder;
use App\User;
// use App\Role;
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        // $this->createRoleUser();
        $this->createUser();
    }
    /**
     * [createUser description]
     * @return [type] [description]
     */
    public function createUser() {
        // $role_user = Role::where('name', 'User')->first();
        // $role_admin = Role::where('name', 'Admin')->first();
        // $role_manager = Role::where('name', 'Manager')->first();

        $user =  new User();
        $user->name = 'user';
        $user->email = 'user@gmail.com';
        $user->role = User::ROLE_USER;
        $user->password = bcrypt('123456');
        $user->save();

        $user_admin =  new User();
        $user_admin->name = 'admin';
        $user_admin->email = 'admin@gmail.com';
        $user_admin->role = User::ROLE_ADMIN;
        $user_admin->password = bcrypt('123456');
        $user_admin->save();

        $user_manager =  new User();
        $user_manager->name = 'manager';
        $user_manager->email = 'manager@gmail.com';
        $user_manager->role = User::ROLE_MANAGER;
        $user_manager->password = bcrypt('123456');
        $user_manager->save();



        // $user->roles()->attach($role_user);
        // $user_admin->roles()->attach($role_admin);
        // $user_manager->roles()->attach($role_manager);
    }
    // public function createRoleUser() {
    //     $role_user = new Role();
    //     $role_user->name = 'User';
    //     $role_user->description = 'A normal user';
    //     $role_user->save();

    //     $role_admin = new Role();
    //     $role_admin->name = 'Admin';
    //     $role_admin->description = 'An Admin';
    //     $role_admin->save();

    //     $role_manager = new Role();
    //     $role_manager->name = 'Manager';
    //     $role_manager->description = 'A Manager';
    //     $role_manager->save();
    // }
}
