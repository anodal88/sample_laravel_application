<?php

use Illuminate\Database\Seeder;

class SeedStatesUS extends Seeder
{

    public function run()
    {

        $user = $manufacturer = DB::table('countries')
            ->where('code', '=', 'US')
            ->select('id')->first();

        DB::table('states')->insert(
            array(
                array('country_id' => $user->id, 'name' => 'Alabama', 'code' => 'AL'),
                array('country_id' => $user->id, 'name' => 'Alaska', 'code' => 'AK'),
                array('country_id' => $user->id, 'name' => 'Arizona', 'code' => 'AZ'),
                array('country_id' => $user->id, 'name' => 'Arkansas', 'code' => 'AR'),
                array('country_id' => $user->id, 'name' => 'California', 'code' => 'CA'),
                array('country_id' => $user->id, 'name' => 'Colorado', 'code' => 'CO'),
                array('country_id' => $user->id, 'name' => 'Connecticut', 'code' => 'CT'),
                array('country_id' => $user->id, 'name' => 'Delaware', 'code' => 'DE'),
                array('country_id' => $user->id, 'name' => 'District of Columbia', 'code' => 'DC'),
                array('country_id' => $user->id, 'name' => 'Florida', 'code' => 'FL'),
                array('country_id' => $user->id, 'name' => 'Georgia', 'code' => 'GA'),
                array('country_id' => $user->id, 'name' => 'Hawaii', 'code' => 'HI'),
                array('country_id' => $user->id, 'name' => 'Idaho', 'code' => 'ID'),
                array('country_id' => $user->id, 'name' => 'Illinois', 'code' => 'IL'),
                array('country_id' => $user->id, 'name' => 'Indiana', 'code' => 'IN'),
                array('country_id' => $user->id, 'name' => 'Iowa', 'code' => 'IA'),
                array('country_id' => $user->id, 'name' => 'Kansas', 'code' => 'KS'),
                array('country_id' => $user->id, 'name' => 'Kentucky', 'code' => 'KY'),
                array('country_id' => $user->id, 'name' => 'Louisiana', 'code' => 'LA'),
                array('country_id' => $user->id, 'name' => 'Maine', 'code' => 'ME'),
                array('country_id' => $user->id, 'name' => 'Maryland', 'code' => 'MD'),
                array('country_id' => $user->id, 'name' => 'Massachusetts', 'code' => 'MA'),
                array('country_id' => $user->id, 'name' => 'Michigan', 'code' => 'MI'),
                array('country_id' => $user->id, 'name' => 'Minnesota', 'code' => 'MN'),
                array('country_id' => $user->id, 'name' => 'Mississippi', 'code' => 'MS'),
                array('country_id' => $user->id, 'name' => 'Missouri', 'code' => 'MO'),
                array('country_id' => $user->id, 'name' => 'Montana', 'code' => 'MT'),
                array('country_id' => $user->id, 'name' => 'Nebraska', 'code' => 'NE'),
                array('country_id' => $user->id, 'name' => 'Nevada', 'code' => 'NV'),
                array('country_id' => $user->id, 'name' => 'New Hampshire', 'code' => 'NH'),
                array('country_id' => $user->id, 'name' => 'New Jersey', 'code' => 'NJ'),
                array('country_id' => $user->id, 'name' => 'New Mexico', 'code' => 'NM'),
                array('country_id' => $user->id, 'name' => 'New York', 'code' => 'NY'),
                array('country_id' => $user->id, 'name' => 'North Carolina', 'code' => 'NC'),
                array('country_id' => $user->id, 'name' => 'North Dakota', 'code' => 'ND'),
                array('country_id' => $user->id, 'name' => 'Ohio', 'code' => 'OH'),
                array('country_id' => $user->id, 'name' => 'Oklahoma', 'code' => 'OK'),
                array('country_id' => $user->id, 'name' => 'Oregon', 'code' => 'OR'),
                array('country_id' => $user->id, 'name' => 'Pennsylvania', 'code' => 'PA'),
                array('country_id' => $user->id, 'name' => 'Rhode Island', 'code' => 'RI'),
                array('country_id' => $user->id, 'name' => 'South Carolina', 'code' => 'SC'),
                array('country_id' => $user->id, 'name' => 'South Dakota', 'code' => 'SD'),
                array('country_id' => $user->id, 'name' => 'Tennessee', 'code' => 'TN'),
                array('country_id' => $user->id, 'name' => 'Texas', 'code' => 'TX'),
                array('country_id' => $user->id, 'name' => 'Utah', 'code' => 'UT'),
                array('country_id' => $user->id, 'name' => 'Vermont', 'code' => 'VT'),
                array('country_id' => $user->id, 'name' => 'Virginia', 'code' => 'VA'),
                array('country_id' => $user->id, 'name' => 'Washington', 'code' => 'WA'),
                array('country_id' => $user->id, 'name' => 'West Virginia', 'code' => 'WV'),
                array('country_id' => $user->id, 'name' => 'Wisconsin', 'code' => 'WI'),
                array('country_id' => $user->id, 'name' => 'Wyoming', 'code' => 'WY')
            ));
    }
}