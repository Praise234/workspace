<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('products')->insert([
            'name' => 'Private Offices',
            'slug' => 'private_offices',
            'open_saturday' => 1,
            'open_sunday' => 1,
            'total_slots' => 21,
            'imgUrl' => 'OSotk7JHhnxaWDhogL2cH04gQaq8EYLUdMtMXXa6.jpg',
        ]);
       \DB::table('products')->insert([
            'name' => 'Coworkspace',
            'slug' => 'coworkspace',
            'open_saturday' => 1,
            'open_sunday' => 1,
            'total_slots' => 10,
            'imgUrl' => 'eRn9jA7MDpuMED82gRka75XIl6FopACQocKldVTs.jpg',
        ]);
        \DB::table('products')->insert([
            'name' => 'Meeting Room',
            'slug' => 'meeting_room',
            'open_saturday' => 1,
            'open_sunday' => 1,
            'total_slots' => 20,
            'imgUrl' => '5xRkgVFBmdm65KGK54zn3z8hZBX6qMuee2lQ75l0.jpg',
        ]);
        \DB::table('products')->insert([
            'name' => 'Virtual Office',
            'slug' => 'virtual_office',
            'open_saturday' => 1,
            'open_sunday' => 1,
            'total_slots' => 20,
            'imgUrl' => '31RtQkFRkpVCBQdNGRl2gK4O9xJO91p3h8FCOKru.jpg',
        ]);
        // \DB::table('products')->insert([
        //     'name' => 'children_playroom',
        //     'slug' => 'virtual_office',
        //     'open_saturday' => 1,
        //     'open_sunday' => 1,
        //     'total_slots' => 20,
        //     'imgUrl' => '3JtAOqde9q3cMOeuFm5h2M9s9eLl2GN5BdVqniZJ.jpg',
        // ]);
        \DB::table('products')->insert([
            'name' => 'Event Space',
            'slug' => 'event_space',
            'open_saturday' => 1,
            'open_sunday' => 1,
            'total_slots' => 1,
            'imgUrl' => 'fzbqVsOpqeQsT4jAaUllV5v09WDbAwEIEfwzhKXO.jpg',
        ]);
    }
}
