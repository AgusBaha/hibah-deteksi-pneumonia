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
            ['category_id' => Category::where('name', 'Kanker Payudara')->first()->id, 'question' => 'Apakah Anda merasakan benjolan di payudara atau ketiak saat melakukan pemeriksaan payudara sendiri?', 'weight' => 10],
            ['category_id' => Category::where('name', 'Kanker Payudara')->first()->id, 'question' => 'Apakah ada perubahan bentuk atau ukuran payudara yang tidak biasa?', 'weight' => 10],
            ['category_id' => Category::where('name', 'Kanker Payudara')->first()->id, 'question' => 'Apakah Anda memperhatikan adanya perubahan pada kulit payudara, seperti kemerahan, kerutan, atau kulit yang tampak seperti kulit jeruk?', 'weight' => 10],
            ['category_id' => Category::where('name', 'Kanker Payudara')->first()->id, 'question' => 'Apakah puting Anda terlihat masuk ke dalam (retraksi) atau berubah posisi?', 'weight' => 10],
            ['category_id' => Category::where('name', 'Kanker Payudara')->first()->id, 'question' => 'Apakah Anda melihat adanya cairan yang keluar dari puting, seperti cairan berdarah atau berwarna kuning, yang tidak terkait dengan menyusui?', 'weight' => 10],


            ['category_id' => Category::where('name', 'Kanker Serviks')->first()->id, 'question' => 'Apakah Anda mengalami perdarahan di luar siklus menstruasi, setelah hubungan seksual, atau setelah menopause?', 'weight' => 10],
            ['category_id' => Category::where('name', 'Kanker Serviks')->first()->id, 'question' => 'Apakah keputihan Anda berubah menjadi lebih banyak, berbau tidak sedap, atau berwarna tidak biasa?', 'weight' => 10],
            ['category_id' => Category::where('name', 'Kanker Serviks')->first()->id, 'question' => 'Apakah Anda merasa nyeri saat berhubungan seksual atau di area panggul?', 'weight' => 10],
            ['category_id' => Category::where('name', 'Kanker Serviks')->first()->id, 'question' => 'Kapan terakhir kali Anda melakukan pap smear? Apa hasilnya?', 'weight' => 10],
            ['category_id' => Category::where('name', 'Kanker Serviks')->first()->id, 'question' => 'Apakah Anda pernah didiagnosis dengan infeksi HPV atau infeksi menular seksual lainnya?', 'weight' => 10],

            ['category_id' => Category::where('name', 'Kanker Paru-Paru')->first()->id, 'question' => 'Apakah Anda mengalami batuk kronis (lebih dari tiga minggu)?', 'weight' => 10],
            ['category_id' => Category::where('name', 'Kanker Paru-Paru')->first()->id, 'question' => 'Apakah Anda pernah batuk darah atau lendir bercampur darah?', 'weight' => 10],
            ['category_id' => Category::where('name', 'Kanker Paru-Paru')->first()->id, 'question' => 'Apakah Anda sering mengalami nyeri dada yang memburuk saat bernapas dalam atau batuk?', 'weight' => 10],
            ['category_id' => Category::where('name', 'Kanker Paru-Paru')->first()->id, 'question' => 'Apakah Anda merasa sulit bernapas, terutama saat beraktivitas ringan?', 'weight' => 10],
            ['category_id' => Category::where('name', 'Kanker Paru-Paru')->first()->id, 'question' => 'Apakah suara Anda sering serak dan tidak kunjung sembuh?', 'weight' => 10],
        ];

        foreach ($specificQuestions as $specificQuestion) {
            SpecificQuestion::create($specificQuestion);
        }
    }
}
