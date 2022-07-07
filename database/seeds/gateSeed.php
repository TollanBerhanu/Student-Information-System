<?php

use Illuminate\Database\Seeder;


class gateSeed extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Model\Gate\block_gate::class, 10)->create();
        factory(App\Model\Gate\gate::class, 25)->create();
        factory(App\Model\Gate\gate_emp_record::class, 10)->create();
        factory(App\Model\Gate\pc::class, 25)->create();
    }
}
