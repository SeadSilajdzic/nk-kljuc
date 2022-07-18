<?php

namespace Database\Seeders;

use App\Models\Dashboard\Category\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::factory()->count(5)->create();
    }
}
