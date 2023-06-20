<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VariationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('variations')->insert([
            'product_id' => 2,
            'variation_type' => 'daily',
            'price' => 5000,
        ]);
        \DB::table('variations')->insert([
            'product_id' => 2,
            'variation_type' => 'weekly',
            'price' => 25000,
        ]);
        \DB::table('variations')->insert([
            'product_id' => 2,
            'variation_type' => 'monthly',
            'price' => 100000,
        ]);
        \DB::table('variations')->insert([
            'product_id' => 1,
            'variation_type' => 'monthly',
            'price' => 300000,
        ]);
        \DB::table('variations')->insert([
            'product_id' => 3,
            'variation_type' => 'hourly',
            'price' => 25000,
        ]);
        \DB::table('variations')->insert([
            'product_id' => 4,
            'variation_type' => 'monthly',
            'price' => 35000,
        ]);
        \DB::table('variations')->insert([
            'product_id' => 5,
            'variation_type' => 'monthly',
            'price' => 50000,
        ]);
    }
}
