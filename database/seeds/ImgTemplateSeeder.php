<?php

use Illuminate\Database\Seeder;

class ImgTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\ImgTemplate::class, 10) ->create();
    }
}
