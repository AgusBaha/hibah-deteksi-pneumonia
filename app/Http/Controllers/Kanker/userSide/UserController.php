<?php

namespace App\Http\Controllers\Kanker\userSide;

use App\Http\Controllers\Controller;
use App\Models\Kanker\Category;
use App\Models\Kanker\MainQuestion;
use App\Models\Kanker\SpecificQuestion;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $mainQuestion = MainQuestion::first();
        $specificQuestions = SpecificQuestion::where('category_id', 1)->get();

        if ($mainQuestion) {
            $question_type = 'main';
            return view('kanker.user.detect', compact('mainQuestion', 'question_type'));
        } elseif ($specificQuestions->isNotEmpty()) {
            $question_type = 'specific';
            $specificQuestion = $specificQuestions->first();
            return view('kanker.user.detect', compact('specificQuestion', 'question_type'));
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
        $categoryId = $request->input('category_id');

        if ($questionType == 'main') {
            $nextQuestion = MainQuestion::where('id', '>', $currentQuestionId)->first();

            if ($answer == 'yes') {
                $totalYesCount++;
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
                        'category_id' => $firstCategory->id
                    ]);
                }
            }

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

        if ($questionType == 'specific') {
            $category = Category::with('specificQuestions')->find($categoryId);
            $nextQuestion = $category->specificQuestions->where('id', '>', $currentQuestionId)->first();

            if ($answer == 'yes') {
                $totalYesCount++;
            }

            // Cek apakah total "IYA" telah mencapai 3
            if ($totalYesCount >= 6) {
                return response()->json([
                    'status' => 'complete',
                    'message' => 'Deteksi selesai, bobot sudah tercapai untuk kategori: ' . $category->name,
                    'yes_count' => $totalYesCount,
                ]);
            }

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
                        'category_id' => $nextCategory->id
                    ]);
                } else {
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
                'category_id' => $category->id
            ]);
        }
    }
}
