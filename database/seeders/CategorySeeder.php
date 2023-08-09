<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $categories = [
            'Career Advisors',
            'Family & Friends',
            'Fun Facilitators',
            'Hobby Explorers',
            'Knowledge Navigators',
            'Mystical Guides',
            'Parenting Pals',
            'Wellness Gurus',
        ];

        foreach ($categories as $category) {
            \App\Models\Category::create([
                'title' => $category,
                'slug' => \Illuminate\Support\Str::slug($category),
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.',
            ]);
        }
    }
}
