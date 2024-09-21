<?php

namespace App\Http\Controllers\Kanker\adminSide;

use App\Http\Controllers\Controller;
use App\Models\Kanker\UserResponse;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    public function index()
    {
        // Ambil data hasil jawaban dengan eager loading
        $results = UserResponse::with('category') // Pastikan ada relasi ke model Category
            ->selectRaw('category_id, SUM(respondent_count) as total_yes') // Ganti total_yes_count dengan respondent_count
            ->groupBy('category_id')
            ->get();

        // Ambil nama kategori dan jumlah "yes"
        $categories = [];
        $yesCounts = [];

        foreach ($results as $result) {
            if ($result->category) {
                $categories[] = $result->category->name;
                $yesCounts[] = $result->total_yes;
            }
        }

        return view('kanker.admin.chart.index', compact('categories', 'yesCounts'));
    }
}
