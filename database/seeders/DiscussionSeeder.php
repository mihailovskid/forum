<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Discussion;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DiscussionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();
        $users      = User::all();

        $data = [];
        for ($i = 0; $i < 5; $i++) {
            $data[] = [
                'title'         => fake()->name,
                'img_url'       => fake()->imageUrl(),
                'description'   => fake()->text(100),
                'status'        => rand(0, 1),
                'user_id'       => $users->random(1)->first()->id,
                'category_id'   => $categories->random(1)->first()->id
            ];
        }

        Discussion::insert($data);
    }
}
