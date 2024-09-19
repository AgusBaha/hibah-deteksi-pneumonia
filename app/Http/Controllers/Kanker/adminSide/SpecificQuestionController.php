<?php

namespace App\Http\Controllers\Kanker\adminSide;

use App\Http\Controllers\Controller;
use App\Models\Kanker\MainQuestion;
use App\Models\Kanker\SpecificQuestion;
use Illuminate\Http\Request;

class SpecificQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $specificQuestions = SpecificQuestion::with('mainQuestion')->get();
        return view('kanker.admin.SpecificQuestions.index', compact('specificQuestions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $mainQuestions = MainQuestion::all();
        return view('kanker.admin.SpecificQuestions.create', compact('mainQuestions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'main_question_id' => 'required|exists:main_questions,id',
            'question' => 'required|string',
            'weight' => 'nullable|numeric',
        ]);

        SpecificQuestion::create($request->all());

        return redirect()->route('specific-questions.index')->with('success', 'Specific Question created successfully.');
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
    public function edit(SpecificQuestion $specificQuestion)
    {
        $mainQuestions = MainQuestion::all();
        return view('kanker.admin.SpecificQuestions.edit', compact('specificQuestion', 'mainQuestions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SpecificQuestion $specificQuestion)
    {
        $request->validate([
            'main_question_id' => 'required|exists:main_questions,id',
            'question' => 'required|string',
            'weight' => 'nullable|numeric',
        ]);

        $specificQuestion->update($request->all());

        return redirect()->route('specific-questions.index')->with('success', 'Specific Question updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SpecificQuestion $specificQuestion)
    {
        $specificQuestion->delete();

        return redirect()->route('specific-questions.index')->with('success', 'Specific Question deleted successfully.');
    }
}
