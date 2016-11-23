<?php

use Illuminate\Database\Seeder;

class FrameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Create frames
        $frames = factory(App\Frame::class, 4) ->create();
    }
}
