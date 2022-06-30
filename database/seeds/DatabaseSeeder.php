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
        factory(App\Model\Syncable\College::class, 5)->create();
        factory(App\Model\Syncable\Faculty::class, 15)->create();
        factory(App\Model\Syncable\Department::class, 2)->create();
        factory(App\Model\Syncable\Program::class, 10)->create();

        factory(App\Model\Privilege::class, 25)->create();
        factory(App\Model\System::class, 6)->create();
        factory(App\Model\Role::class, 25)->create();
        factory(App\Model\RolePrivilege::class, 100)->create();
        factory(App\Model\Syncable\Student::class, 100)->create();
        factory(App\Model\User::class, 2)->create();
    }
}
