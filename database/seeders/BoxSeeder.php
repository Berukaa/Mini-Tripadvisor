<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BoxSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('boxes')->insert([
            'name' => "MacDonald's",
            'address' => "Classic, long-running fast-food chain known for its burgers, fries & shakes.",
            'city' => "test",
            'postal' => 75001,
            'country' => "blabla",
         ]);
    }
}
