<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use LDAP\Result;

class DetectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function start()
    {
        $mainQuestion = Question::where('is_main', true)->first();
        return view('user.detection.start', compact('mainQuestion'));
    }

    public function answer(Request $request, Question $question)
    {
        $validated = $request->validate([
            'answer' => 'required|boolean',
        ]);

        Answer::create([
            'question_id' => $question->id,
            'answer' => $validated['answer'],
        ]);

        if ($validated['answer']) {
            $nextQuestion = Question::where('parent_id', $question->id)->first();
            if ($nextQuestion) {
                return view('user.detection.question', compact('nextQuestion'));
            } else {
                $totalWeight = Answer::whereHas('question', function ($q) {
                    $q->whereNotNull('weight');
                })->sum('question.weight');

                Result::create([
                    'user_id' => Auth::id(),
                    'total_weight' => $totalWeight,
                ]);

                return view('user.detection.result', compact('totalWeight'));
            }
        } else {
            $totalWeight = 0;

            Result::create([
                'user_id' => Auth::id(),
                'total_weight' => $totalWeight,
            ]);

            return view('user.detection.result', compact('totalWeight'));
        }
    }
}
