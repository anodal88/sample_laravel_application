<?php

use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('statuses')->insert(array(
            array('name'=>'Active'),
            array('name'=>'Paid'),
            array('name'=>'Pending Files'),
            array('name'=>'Shipping'),
            array('name'=>'Shipped')
        ));
    }
}
