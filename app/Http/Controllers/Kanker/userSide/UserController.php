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
        // Misalnya kita ambil pertanyaan utama pertama
        $mainQuestion = MainQuestion::first(); // Ambil pertanyaan utama
        $specificQuestions = SpecificQuestion::where('category_id', 1)->get(); // Ambil pertanyaan spesifik

        // Jika ada pertanyaan utama
        if ($mainQuestion) {
            $question_type = 'main';
            return view('kanker.user.detect', compact('mainQuestion', 'question_type'));
        }
        // Jika tidak ada pertanyaan utama, coba tampilkan pertanyaan spesifik
        elseif ($specificQuestions->isNotEmpty()) {
            $question_type = 'specific';
            $specificQuestion = $specificQuestions->first(); // Ambil pertanyaan spesifik pertama
            return view('kanker.user.detect', compact('specificQuestion', 'question_type'));
        }
        // Jika tidak ada pertanyaan sama sekali, kembalikan pesan error atau view kosong
        else {
            return view('kanker.user.detect')->with('message', 'No questions available.');
        }
    }

    public function processQuestion(Request $request)
    {
        $answer = $request->input('answer');
        $questionType = $request->input('question_type'); // 'main' or 'specific'
        $currentQuestionId = $request->input('current_question_id');
        $totalYesCount = $request->input('yes_count', 0); // Keep track of how many "Yes" answers

        // Main Question logic
        if ($questionType == 'main') {
            $nextQuestion = MainQuestion::where('id', '>', $currentQuestionId)->first();

            if ($answer == 'yes') {
                $totalYesCount++;
            }

            // Check if 3 "Yes" answers were given, if so, move to specific questions
            if ($totalYesCount >= 3) {
                // Redirect to the first specific question
                $firstCategory = Category::with('specificQuestions')->first();
                $nextQuestion = $firstCategory->specificQuestions->first();
                return response()->json([
                    'question_type' => 'specific',
                    'question' => $nextQuestion->question,
                    'question_id' => $nextQuestion->id,
                    'category' => $firstCategory->name,
                    'yes_count' => $totalYesCount,
                ]);
            }

            // If there are no more main questions
            if (!$nextQuestion) {
                return response()->json([
                    'status' => 'complete',
                    'message' => 'Tidak terindikasi apapun',
                    'yes_count' => $totalYesCount,
                ]);
            }

            return response()->json([
                'question_type' => 'main',
                'question' => $nextQuestion->question,
                'question_id' => $nextQuestion->id,
                'yes_count' => $totalYesCount,
            ]);
        }

        // Specific Question logic
        if ($questionType == 'specific') {
            $categoryId = $request->input('category_id');
            $category = Category::with('specificQuestions')->find($categoryId);
            $nextQuestion = $category->specificQuestions->where('id', '>', $currentQuestionId)->first();

            if ($answer == 'yes') {
                $totalYesCount++;
            }

            // Check if there are no more specific questions in this category
            if (!$nextQuestion) {
                $nextCategory = Category::where('id', '>', $categoryId)->with('specificQuestions')->first();
                if ($nextCategory) {
                    $nextQuestion = $nextCategory->specificQuestions->first();
                    return response()->json([
                        'question_type' => 'specific',
                        'question' => $nextQuestion->question,
                        'question_id' => $nextQuestion->id,
                        'category' => $nextCategory->name,
                        'yes_count' => $totalYesCount,
                    ]);
                } else {
                    // End of all specific questions and categories
                    return response()->json([
                        'status' => 'complete',
                        'message' => 'Semua pertanyaan spesifik selesai',
                        'yes_count' => $totalYesCount,
                    ]);
                }
            }

            return response()->json([
                'question_type' => 'specific',
                'question' => $nextQuestion->question,
                'question_id' => $nextQuestion->id,
                'category' => $category->name,
                'yes_count' => $totalYesCount,
            ]);
        }
    }
}
