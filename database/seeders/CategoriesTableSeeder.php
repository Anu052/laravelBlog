<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create(['name' => 'Game']);
        Category::create(['name' => 'Music']);
        Category::create(['name' => 'Sport']);
        Category::create(['name' => 'Tech']);
        Category::create(['name' => 'Food']);
    }
}
