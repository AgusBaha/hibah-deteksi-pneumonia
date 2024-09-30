<?php

namespace Database\Seeders;

use App\Models\Kanker\Category;
use App\Models\Kanker\SpecificQuestion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpecificQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $specificQuestions = [
            ['category_id' => Category::where('name', 'Kanker Payudara')->first()->id, 'question' => 'Apakah Anda merasakan benjolan di payudara?', 'weight' => 15],
            ['category_id' => Category::where('name', 'Kanker Paru-Paru')->first()->id, 'question' => 'Apakah Anda sering batuk berdarah?', 'weight' => 20],
        ];

        foreach ($specificQuestions as $specificQuestion) {
            SpecificQuestion::create($specificQuestion);
        }
    }
}
