<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $questions = Question::all();
        return view('kanker.question.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $mainQuestions = Question::where('is_main', true)->get();
        return view('kanker.question.form', compact('mainQuestions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'question_text' => 'required|string',
            'parent_id' => 'nullable|exists:questions,id',
            'weight' => 'nullable|integer',
        ]);

        $validated['is_main'] = $request->has('is_main');

        Question::create($validated);

        return redirect()->route('question.index')->with('success', 'Pertanyaan berhasil ditambahkan.');
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
    public function edit(Question $question)
    {
        $mainQuestions = Question::where('is_main', true)->get();
        return view('kanker.question.form', compact('question', 'mainQuestions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Question $question)
    {
        $validated = $request->validate([
            'question_text' => 'required|string',
            'parent_id' => 'nullable|exists:questions,id',
            'weight' => 'nullable|integer',
        ]);

        $validated['is_main'] = $request->has('is_main');

        $question->update($validated);

        return redirect()->route('question.index')->with('success', 'Pertanyaan berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {
        $question->delete();
        return redirect()->route('question.index')->with('success', 'Pertanyaan berhasil dihapus.');
    }
}
