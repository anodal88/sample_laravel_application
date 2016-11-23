<?php

use Illuminate\Database\Seeder;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('colors')->insert(array(
            array('name'=>'Gold','code'=>'#b8860b'),
            array('name'=>'Red','code'=>'#e57373'),
            array('name'=>'White','code'=>'#FFFFFF'),
            array('name'=>'Blue','code'=>'#b3e5fc'),
            array('name'=>'Black','code'=>'#000000'),
            array('name'=>'Green','code'=>'#80cbc4'),
        ));
    }
}
