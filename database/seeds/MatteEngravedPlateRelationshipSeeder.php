<?php

use Illuminate\Database\Seeder;

class MatteEngravedPlateRelationshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $mts = App\MatteTemplate::all();
        $eps = App\EngravedPlate::all();
        foreach ($mts as $m){
            $random=$eps->random();
            $exist=DB::table('engravedplate_mattetemplate')->where([
                    ['mattetemplate_id', $m->id],
                    ['engravedplate_id', $random->id],
                ])->first();
            if(!$exist){
                $m->engravedplates()->attach($random->id,[
                    'row'=>rand(1,3),
                    'column'=>rand(1,3),
                    'rowspan'=>rand(0,3),
                    'colspan'=>rand(0,3),
                    'marginTop'=>rand(0,3),
                    'marginLeft'=>rand(0,3),
                    'marginBottom'=>rand(0,3),
                    'marginRight'=>rand(0,3),
                    'order'=>rand(1,2)
                ]);
            }

        }
    }
}
