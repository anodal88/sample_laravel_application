<?php

use Illuminate\Database\Seeder;

class EngravedPlateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $eps = factory(App\EngravedPlate::class, 10) ->create();
    }
}
