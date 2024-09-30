<?php

namespace Database\Seeders;

use App\Models\Kanker\Category;
use App\Models\Kanker\UserResponse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserResponseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $userResponses = [
            ['category_id' => Category::where('name', 'Kanker Payudara')->first()->id, 'respondent_count' => 100, 'yes_count' => 40, 'no_count' => 60],
            ['category_id' => Category::where('name', 'Kanker Paru-Paru')->first()->id, 'respondent_count' => 80, 'yes_count' => 50, 'no_count' => 30],
        ];

        foreach ($userResponses as $userResponse) {
            UserResponse::create($userResponse);
        }
    }
}
