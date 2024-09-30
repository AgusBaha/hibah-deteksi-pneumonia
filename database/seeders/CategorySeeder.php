<?php

namespace Database\Seeders;

use App\Models\Kanker\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $categories = [
            ['name' => 'Kanker Payudara', 'descriptions' => 'Kategori pertanyaan seputar kanker payudara'],
            ['name' => 'Kanker Paru-Paru', 'descriptions' => 'Kategori pertanyaan seputar kanker paru-paru'],
            ['name' => 'Kanker Serviks', 'descriptions' => 'Kategori pertanyaan seputar kanker serviks'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
