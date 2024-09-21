<?php

namespace App\Http\Controllers\Kanker\adminSide;

use App\Http\Controllers\Controller;
use App\Models\Kanker\UserResponse;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    public function index()
    {
        // Ambil data hasil jawaban
        $results = UserResponse::selectRaw('category_id, SUM(total_yes_count) as total_yes')
            ->groupBy('category_id')
            ->get();

        // Ambil nama kategori dan jumlah "yes"
        $categories = [];
        $yesCounts = [];

        foreach ($results as $result) {
            if ($result->category) {
                $categories[] = $result->category->name;  // Asumsikan ada relasi ke model Category
                $yesCounts[] = $result->total_yes;
            }
        }

        return view('kanker.admin.chart.index', compact('categories', 'yesCounts'));
    }
}
