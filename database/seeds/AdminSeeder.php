<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public static function run()
    {
        DB::table('Systems')->insert([
            'name' => "Admin",
            'description' => "X",
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);

        DB::table('Privileges')->insert([
            'name' => "role_list",
            'description' => "X",
            'system_id' => 1,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('Privileges')->insert([
            'name' => "role_update",
            'description' => "X",
            'system_id' => 1,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('Privileges')->insert([
            'name' => "role_register",
            'description' => "X",
            'system_id' => 1,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('Privileges')->insert([
            'name' => "role_privilege",
            'description' => "X",
            'system_id' => 1,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('Privileges')->insert([
            'name' => "privilege_list",
            'description' => "X",
            'system_id' => 1,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('Privileges')->insert([
            'name' => "privilege_register",
            'description' => "X",
            'system_id' => 1,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);


        DB::table('Roles')->insert([
            'name' => "Super Admin",
            'description' => "X",
            'system_id' => 1,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);

        DB::table('Role_privileges')->insert([
            'role_id' => 1,
            'privilege_id' => 1,
            'status' => 1,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('Role_privileges')->insert([
            'role_id' => 1,
            'privilege_id' => 2,
            'status' => 1,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('Role_privileges')->insert([
            'role_id' => 1,
            'privilege_id' => 3,
            'status' => 1,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('Role_privileges')->insert([
            'role_id' => 1,
            'privilege_id' => 4,
            'status' => 1,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('Role_privileges')->insert([
            'role_id' => 1,
            'privilege_id' => 5,
            'status' => 1,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('Role_privileges')->insert([
            'role_id' => 1,
            'privilege_id' => 6,
            'status' => 1,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);

        DB::table('users')->insert([
            'first_name' => "Super",
            'last_name' => "Admin",
            'email' => "SuperAdmin@system.com",
            'password' => Hash::make('admin'),
            'phone_number' => "+251930675432",
            'profile' => "media/team/awol.jpg",
            'sex' => "Male",
            'status' => true,
            'email_verified_at' => new DateTime(),
            'college_id' => null,
            'role_id' => 1
        ]);
    }
}
