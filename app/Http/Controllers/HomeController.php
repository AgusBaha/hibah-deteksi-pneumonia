<?php

namespace App\Http\Controllers;

use App\Models\BasisKasus;
use App\Models\gejala;
use App\Models\Kanker\Category;
use App\Models\Kanker\MainQuestion;
use App\Models\Kanker\SpecificQuestion;
use App\Models\Question;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $month = date('F');
        $categories = Category::count();
        $mainQuestions = MainQuestion::count();
        $specificQuestions = SpecificQuestion::count();
        return view('dashboard.index', ['bulan' => $month, 'categories' => $categories, 'mainQuestions' => $mainQuestions, 'specificQuestions' => $specificQuestions]);
    }
}
