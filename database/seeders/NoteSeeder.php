<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('notes')->insert([
            'commentary' => "MacDonald's",
            'author' => "Classic, long-running fast-food chain known for its burgers, fries & shakes.",
            'note' => 1
         ]);
    }
}
