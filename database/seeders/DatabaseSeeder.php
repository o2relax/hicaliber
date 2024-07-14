<?php

namespace Database\Seeders;

use App\Models\Entity;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Entity::query()->truncate();
        Entity::factory(50)->create();
    }
}
