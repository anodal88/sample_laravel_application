<?php

use Illuminate\Database\Seeder;


class MatteImagesRelationshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $mts = App\MatteTemplate::all();
        $its = App\ImgTemplate::all();
        foreach ($mts as $m){

            $maxRelations= rand(1,3);
            $associatedImages=array();
            for($i=0; $i<$maxRelations;$i++){
                $random=$its->random();
                $exist=DB::table('imgtemplate_mattetemplate')->where([
                    ['mattetemplate_id', $m->id],
                    ['imgtemplate_id', $random->id],
                ])->first();
                if(!$exist){
                   $m->imgtemplates()->attach($random->id,[
                       'row'=>rand(1,3),
                       'column'=>rand(1,3),
                       'rowspan'=>rand(0,3),
                       'colspan'=>rand(0,3),
                       'marginTop'=>rand(0,3),
                       'marginLeft'=>rand(0,3),
                       'marginBottom'=>rand(0,3),
                       'marginRight'=>rand(0,3),
                       'order'=>rand(1,4)
                   ]);
                }
            }
        }
    }
}
