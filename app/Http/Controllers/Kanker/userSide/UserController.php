<?php

namespace App\Http\Controllers\Kanker\userSide;

use App\Http\Controllers\Controller;
use App\Models\Kanker\MainQuestion;
use App\Models\Kanker\SpecificQuestion;
use App\Models\Kanker\UserResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function start()
    {
        $mainQuestions = MainQuestion::all();
        return view('user.start', compact('mainQuestions'));
    }

    public function answer(Request $request)
    {
        // Simpan jawaban user
        $response = new UserResponse();
        $response->question_id = $request->question_id;
        $response->question_type = $request->question_type; // 'main' or 'specific'
        $response->response = $request->response;
        $response->weight = $request->weight; // Bobot berdasarkan jawaban
        $response->save();

        // Logic untuk lanjut ke pertanyaan berikutnya
        // Jika jawabannya 'yes', maka lanjut ke specific question
        if ($request->response == 'yes') {
            $specificQuestions = SpecificQuestion::where('main_question_id', $request->question_id)->get();
            return view('user.specific', compact('specificQuestions'));
        }

        return redirect()->route('user.summary');
    }

    public function summary()
    {
        // Kalkulasi total bobot dan tampilkan summary
        $totalWeight = UserResponse::sum('weight');
        return view('user.summary', compact('totalWeight'));
    }
}
