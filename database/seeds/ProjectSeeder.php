<?php

use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 5) ->create()->each(function ($u)  {

            $ru = App\Role::where('name','user')->first();
            if($ru instanceof Role){
                $u->roles()->sync($ru->id);
            }
        });

            factory(App\Project::class, 80) ->create()->each(function ($p)  {

                $cI= $p->mattetemplate->imgtemplates()->count();
                $p->text()->save(factory(App\Text::class)->make());
                for ($i=0;$i<$cI;$i++){
                    $p->images()->save(factory(App\Image::class)->make());
                }

            });



    }
}
