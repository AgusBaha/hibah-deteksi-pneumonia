<?php

namespace App\Http\Controllers\Kanker\userSide;

use App\Http\Controllers\Controller;
use App\Models\Kanker\Category;
use App\Models\Kanker\MainQuestion;
use App\Models\Kanker\SpecificQuestion;
use App\Models\Kanker\UserResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $mainQuestion = MainQuestion::first();
        if ($mainQuestion) {
            $question_type = 'main';
            return view('kanker.user.detect', compact('mainQuestion', 'question_type'));
        } else {
            return view('kanker.user.detect')->with('message', 'No questions available.');
        }
    }

    public function processQuestion(Request $request)
    {
        $answer = $request->input('answer');
        $questionType = $request->input('question_type');
        $currentQuestionId = $request->input('current_question_id');
        $totalYesCount = $request->input('yes_count', 0);
        $totalNoCount = $request->input('no_count', 0); // Tambahkan tracking untuk jawaban "tidak"
        $categoryId = $request->input('category_id');

        // Logika pertanyaan utama
        if ($questionType == 'main') {
            $nextQuestion = MainQuestion::where('id', '>', $currentQuestionId)->first();

            if ($answer == 'yes') {
                $totalYesCount++;
            } else {
                $totalNoCount++;
            }

            if ($totalYesCount >= 3) {
                $firstCategory = Category::with('specificQuestions')->first();
                if ($firstCategory) {
                    $nextQuestion = $firstCategory->specificQuestions->first();
                    return response()->json([
                        'status' => 'next',
                        'question_type' => 'specific',
                        'question' => $nextQuestion->question,
                        'question_id' => $nextQuestion->id,
                        'category' => $firstCategory->name,
                        'yes_count' => $totalYesCount,
                        'no_count' => $totalNoCount,
                        'category_id' => $firstCategory->id
                    ]);
                }
            }

            if (!$nextQuestion) {
                // Simpan hasil jawaban ke database
                UserResponse::create([
                    'category_id' => null,
                    'yes_count' => $totalYesCount,
                    'no_count' => $totalNoCount,
                    'respondent_count' => 1,
                ]);

                return response()->json([
                    'status' => 'complete',
                    'message' => 'Tidak terindikasi apapun',
                    'yes_count' => $totalYesCount,
                    'no_count' => $totalNoCount,
                ]);
            }

            return response()->json([
                'question_type' => 'main',
                'question' => $nextQuestion->question,
                'question_id' => $nextQuestion->id,
                'yes_count' => $totalYesCount,
                'no_count' => $totalNoCount,
            ]);
        }

        // Logika untuk pertanyaan spesifik
        if ($questionType == 'specific') {
            $category = Category::with('specificQuestions')->find($categoryId);
            $nextQuestion = $category->specificQuestions->where('id', '>', $currentQuestionId)->first();

            if ($answer == 'yes') {
                $totalYesCount++;
            } else {
                $totalNoCount++;
            }

            if ($totalYesCount >= 6) {
                // Simpan hasil jawaban spesifik
                UserResponse::create([
                    'category_id' => $category->id,
                    'yes_count' => $totalYesCount,
                    'no_count' => $totalNoCount,
                    'respondent_count' => 1,
                ]);

                return response()->json([
                    'status' => 'complete',
                    'message' => 'Terindikasi kanker pada kategori: <strong>' . $category->name . '</strong>',
                    'yes_count' => $totalYesCount,
                    'no_count' => $totalNoCount,
                    'category_description' => $category->descriptions
                ]);
            }

            if (!$nextQuestion) {
                // Lanjut ke kategori berikutnya atau simpan hasil akhir
                $nextCategory = Category::where('id', '>', $categoryId)->with('specificQuestions')->first();
                if ($nextCategory && $nextCategory->specificQuestions->isNotEmpty()) {
                    $nextQuestion = $nextCategory->specificQuestions->first();
                    return response()->json([
                        'question_type' => 'specific',
                        'question' => $nextQuestion->question,
                        'question_id' => $nextQuestion->id,
                        'category' => $nextCategory->name,
                        'yes_count' => $totalYesCount,
                        'no_count' => $totalNoCount,
                        'category_id' => $nextCategory->id
                    ]);
                } else {
                    UserResponse::create([
                        'category_id' => $categoryId,
                        'yes_count' => $totalYesCount,
                        'no_count' => $totalNoCount,
                        'respondent_count' => 1,
                    ]);

                    return response()->json([
                        'status' => 'complete',
                        'message' => 'Semua pertanyaan selesai, tidak terindikasi apapun.',
                        'yes_count' => $totalYesCount,
                        'no_count' => $totalNoCount,
                    ]);
                }
            }

            return response()->json([
                'question_type' => 'specific',
                'question' => $nextQuestion->question,
                'question_id' => $nextQuestion->id,
                'category' => $category->name,
                'yes_count' => $totalYesCount,
                'no_count' => $totalNoCount,
                'category_id' => $category->id
            ]);
        }
    }
}
