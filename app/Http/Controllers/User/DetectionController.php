<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;

class DetectionController extends Controller
{
    public function start()
    {
        // Ambil pertanyaan pertama yang merupakan pertanyaan utama
        $mainQuestion = Question::where('is_main', true)->first();
        return view('kanker.userDetection.index', compact('mainQuestion'));
    }

    public function answer(Request $request, Question $question)
    {
        // Validasi input jawaban
        $validated = $request->validate([
            'answer' => 'required|boolean',
        ]);

        // Simpan jawaban user
        Answer::create([
            'question_id' => $question->id,
            'answer' => $validated['answer'],
        ]);

        // Jika jawaban "YA", cari pertanyaan berikutnya
        if ($validated['answer']) {
            $nextQuestion = Question::where('parent_id', $question->id)->first();
            if ($nextQuestion) {
                return view('kanker.userDetection.index', compact('nextQuestion'));
            } else {
                // Hitung total bobot dari jawaban
                $totalWeight = Answer::join('questions', 'answers.question_id', '=', 'questions.id')
                    ->whereNotNull('questions.weight')
                    ->sum('questions.weight');

                return view('kanker.userDetection.result', compact('totalWeight'));
            }
        } else {
            // Jika jawaban "TIDAK", atau tidak ada pertanyaan lebih lanjut
            $totalWeight = 0;
            return view('kanker.userDetection.result', compact('totalWeight'));
        }
    }
}
