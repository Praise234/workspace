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
        DB::table('products')->insert([
            'name' => 'private_offices',
            'duration' => 4,
            'total_slots' => 21,
            'price' => 300000,
            'imgUrl' => 'OSotk7JHhnxaWDhogL2cH04gQaq8EYLUdMtMXXa6.jpg',
        ]);
        DB::table('products')->insert([
            'name' => 'coworkspace',
            'duration' => 2,
            'total_slots' => 10,
            'price' => 2000,
            'imgUrl' => 'eRn9jA7MDpuMED82gRka75XIl6FopACQocKldVTs.jpg',
        ]);
        DB::table('products')->insert([
            'name' => 'meeting_room',
            'duration' => 1,
            'total_slots' => 20,
            'price' => 25000,
            'imgUrl' => '5xRkgVFBmdm65KGK54zn3z8hZBX6qMuee2lQ75l0.jpg',
        ]);
        DB::table('products')->insert([
            'name' => 'virtual_office',
            'duration' => 4,
            'total_slots' => 20,
            'price' => 35000,
            'imgUrl' => '31RtQkFRkpVCBQdNGRl2gK4O9xJO91p3h8FCOKru.jpg',
        ]);
        DB::table('products')->insert([
            'name' => 'children_playroom',
            'duration' => 2,
            'total_slots' => 20,
            'price' => 3000,
            'imgUrl' => '3JtAOqde9q3cMOeuFm5h2M9s9eLl2GN5BdVqniZJ.jpg',
        ]);
        DB::table('products')->insert([
            'name' => 'event_space',
            'duration' => 1,
            'total_slots' => 1,
            'price' => 50000,
            'imgUrl' => 'fzbqVsOpqeQsT4jAaUllV5v09WDbAwEIEfwzhKXO.jpg',
        ]);
        DB::table('products')->insert([
            'name' => 'coworkspace_weekly',
            'duration' => 3,
            'total_slots' => 7,
            'price' => 2000,
            'imgUrl' => 'eRn9jA7MDpuMED82gRka75XIl6FopACQocKldVTs.jpg',
        ]);
        DB::table('products')->insert([
            'name' => 'coworkspace_monthly',
            'duration' => 4,
            'total_slots' => 7,
            'price' => 2000,
            'imgUrl' => 'eRn9jA7MDpuMED82gRka75XIl6FopACQocKldVTs.jpg',
        ]);
    }
}
