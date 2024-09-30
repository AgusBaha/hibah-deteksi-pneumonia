<?php

namespace Database\Seeders;

use App\Models\Kanker\MainQuestion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MainQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $mainQuestions = [
            ['question' => 'Apakah Anda pernah merasakan nyeri di bagian dada?', 'weight' => 10],
            ['question' => 'Apakah ada riwayat keluarga yang mengidap kanker?', 'weight' => 20],
        ];

        foreach ($mainQuestions as $mainQuestion) {
            MainQuestion::create($mainQuestion);
        }
    }
}
