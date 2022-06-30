<?php

use Illuminate\Database\Seeder;


class ClinicSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Model\Clinic\Disease::class, 10)->create();
        factory(App\Model\Clinic\Symptom::class, 25)->create();
    }
}
