<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('todos')->insert([
            'done' => false,
            'priority' => rand(1,5),
            'title' => Str::random(10),
            'subtask' => 0
            'user_id' => rand(1,10)
        ]);
    }
}
