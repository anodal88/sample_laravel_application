<?php

use Illuminate\Database\Seeder;
use  Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $this->call('UserTableSeeder');
        $this->call('CountriesTableSeeder');
        $this->call('SeedStatesUS');
        $this->call('CitySeeder');
        $this->call('ColorSeeder');
        $this->call('FrameSeeder');
        $this->call('SizeSeeder');
        $this->call('EngravedPlateSeeder');
        $this->call('MatteTemplateSeeder');
        $this->call('ImgTemplateSeeder');
        $this->call('MatteImagesRelationshipSeeder');
        $this->call('MatteEngravedPlateRelationshipSeeder');
        $this->call('StatusSeeder');
        $this->call('ProjectSeeder');
    }
}
