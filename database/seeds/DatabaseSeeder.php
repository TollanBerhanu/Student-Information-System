<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        AdminSeeder::run();

        factory(App\Model\Syncable\College::class, 5)->create();
        factory(App\Model\Syncable\Faculty::class, 15)->create();
        factory(App\Model\Syncable\Department::class, 30)->create();
        factory(App\Model\Syncable\Program::class, 100)->create();


        factory(App\Model\System::class, 6)->create();
        factory(App\Model\Privilege::class, 25)->create();
        factory(App\Model\Role::class, 25)->create();
        factory(App\Model\RolePrivilege::class, 100)->create();
        factory(App\Model\Syncable\Photo::class, 20)->create();
        factory(App\Model\Syncable\Student::class, 100)->create();
        factory(App\Model\User::class, 5)->create();

    }
}
