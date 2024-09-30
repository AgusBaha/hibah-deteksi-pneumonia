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
        // Validasi input
        $validatedData = $request->validate([
            'answer' => 'required|in:yes,no',
            'question_type' => 'required|in:main,specific',
            'current_question_id' => 'required|integer',
            'yes_count' => 'nullable|integer',
            'no_count' => 'nullable|integer',
            'category_id' => 'nullable|integer',
        ]);

        // Ambil data dari request yang telah divalidasi
        $answer = $validatedData['answer'];
        $questionType = $validatedData['question_type'];
        $currentQuestionId = $validatedData['current_question_id'];
        $totalYesCount = $request->input('yes_count', 0);
        $totalNoCount = $request->input('no_count', 0);
        $categoryId = $request->input('category_id');

        // Logika pertanyaan utama
        if ($questionType == 'main') {
            // Cari pertanyaan berikutnya dalam kategori pertanyaan utama
            $nextQuestion = MainQuestion::where('id', '>', $currentQuestionId)->first();

            // Hitung jumlah jawaban "yes" dan "no"
            if ($answer == 'yes') {
                $totalYesCount++;
            } else {
                $totalNoCount++;
            }

            // Jika jawaban "yes" >= 3, alihkan ke pertanyaan spesifik kategori pertama
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

            // Jika tidak ada pertanyaan selanjutnya (pertanyaan utama habis)
            if (!$nextQuestion) {
                // Simpan hasil jawaban pengguna ke database
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

            // Jika masih ada pertanyaan utama, lanjutkan ke pertanyaan berikutnya
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
            // Ambil kategori pertanyaan spesifik
            $category = Category::with('specificQuestions')->find($categoryId);
            $nextQuestion = $category->specificQuestions->where('id', '>', $currentQuestionId)->first();

            // Hitung jumlah jawaban "yes" dan "no"
            if ($answer == 'yes') {
                $totalYesCount++;
            } else {
                $totalNoCount++;
            }

            // Jika bobot jawaban "yes" >= 60, simpan hasil dan selesai
            $bobotYes = $totalYesCount * 20; // Misal setiap jawaban "yes" bernilai 20
            if ($bobotYes >= 120) {
                // Simpan hasil jawaban spesifik ke database
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

            // Jika tidak ada pertanyaan spesifik selanjutnya, alihkan ke kategori berikutnya
            if (!$nextQuestion) {
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
                    // Simpan hasil akhir jika semua kategori telah selesai
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

            // Jika masih ada pertanyaan spesifik, lanjutkan ke pertanyaan berikutnya
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
