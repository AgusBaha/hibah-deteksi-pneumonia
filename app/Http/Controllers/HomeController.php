<?php

namespace App\Http\Controllers;

use App\Models\gejala;
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
        $dataGejala = gejala::count();
        return view('dashboard.index', ['jumlahGejala' => $dataGejala, 'bulan' => $month]);
    }
}
