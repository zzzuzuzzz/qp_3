<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Article::factory()->count(5)->create(['published_at' => date('Y-m-d H:i:s', rand(1722492000, 1725170400))]);
        Article::factory()->count(15)->create();
    }
}
