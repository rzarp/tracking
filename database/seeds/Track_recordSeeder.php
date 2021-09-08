<?php

use Illuminate\Database\Seeder;

class Track_recordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('track_records')->insert([
            'app_id'            => 'trackingpendaki',
            'dev_id'            => 'pendaki2',
            'hardware_serial'   => '00E7AABBEA116DA4',
            'counter'           => '6',
            'payload'           => 'LTcuNDM0ODM3OzEwOS4yNTIwMTA=',
            'time'              => '2021-08-16 17:19:37',
            'frequency'         => '923',
            'latitude'          => '-7.434837',
            'longitude'        => '109.25201',
            

        ]);

        DB::table('track_records')->insert([
            'app_id'            => 'trackingpendaki',
            'dev_id'            => 'pendaki2',
            'hardware_serial'   => '00E7AABBEA116DA4',
            'counter'           => '7',
            'payload'           => 'LTcuNDM0ODE2OzEwOS4yNTE5MjA=',
            'time'              => '2021-08-16 17:21:46',
            'frequency'         => '923',
            'latitude'          => '-7.434816',
            'longitude'        => '109.25192',
            

        ]);
    }
}
