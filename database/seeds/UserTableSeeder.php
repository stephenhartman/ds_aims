<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_admin  = Role::where('name', 'admin')->first();
        $role_alumni = Role::where('name', 'alumni')->first();

        $admin_user = User::where('email', 'admin@example.com')->first();
        if ($admin_user === null) {
            $admin = new User();
            $admin->name = 'Admin Istrator';
            $admin->email = 'admin@example.com';
            $admin->password = bcrypt('secret');
            $admin->save();
            $admin->roles()->attach($role_admin);
        }

        $users = factory(App\User::class, 100)->create();
        foreach($users as $user)
        {
            $user->roles()->attach($role_alumni);
        }
    }
}
