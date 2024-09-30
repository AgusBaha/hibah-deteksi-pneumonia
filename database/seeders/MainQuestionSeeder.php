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
            ['question' => 'Apakah Anda merasa berat badan Anda turun secara tiba-tiba tanpa alasan yang jelas, seperti tidak sedang diet atau mengubah pola makan?', 'weight' => 1],
            ['question' => 'Apakah Anda sering merasa sangat lelah, meskipun sudah cukup tidur dan beristirahat?', 'weight' => 1],
            ['question' => 'Apakah Anda merasakan sakit atau nyeri di bagian tubuh tertentu yang terus-menerus tanpa tahu penyebabnya?', 'weight' => 1],
            ['question' => 'Apakah Anda menemukan benjolan atau pembengkakan yang tidak biasa di tubuh, seperti di leher, ketiak, atau bagian tubuh lain?', 'weight' => 1],
            ['question' => 'Apakah Anda mengalami perubahan dalam buang air besar, seperti lebih sering atau lebih jarang dari biasanya?', 'weight' => 1],
            ['question' => 'Apakah Anda pernah mengalami perdarahan yang tidak biasa, misalnya dari hidung, gusi, atau bagian tubuh lain yang biasanya tidak berdarah?', 'weight' => 1],
            ['question' => 'Apakah Anda memperhatikan adanya perubahan pada kulit, seperti munculnya bercak, atau tahi lalat yang berubah warna, bentuk, atau ukurannya bertambah besar?', 'weight' => 1],
            ['question' => 'Apakah Anda sering batuk atau suara Anda terdengar serak, dan ini sudah berlangsung lebih dari tiga minggu?', 'weight' => 1],
            ['question' => 'Apakah Anda merasa sulit atau sakit saat menelan makanan atau minuman?', 'weight' => 1],
            ['question' => 'Apakah ada anggota keluarga Anda yang pernah didiagnosis dengan kanker? Jika ya, jenis kanker apa dan pada umur berapa mereka terkena?', 'weight' => 1],
            ['question' => 'Apakah Anda merokok atau minum alkohol dalam jumlah yang cukup banyak dan sering?', 'weight' => 1],
            ['question' => 'Apakah Anda pernah bekerja di tempat yang menggunakan bahan kimia berbahaya atau terpapar radiasi?', 'weight' => 1],
        ];

        foreach ($mainQuestions as $mainQuestion) {
            MainQuestion::create($mainQuestion);
        }
    }
}
