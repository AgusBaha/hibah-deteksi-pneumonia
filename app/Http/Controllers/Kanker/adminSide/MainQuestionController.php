<?php

namespace App\Http\Controllers\Kanker\adminSide;

use App\Http\Controllers\Controller;
use App\Models\Kanker\Category;
use App\Models\Kanker\MainQuestion;
use Illuminate\Http\Request;

class MainQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mainQuestions = MainQuestion::with('category')->get();
        return view('admin.main_questions.index', compact('mainQuestions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.main_questions.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'question' => 'required|string',
            'weight' => 'nullable|numeric',
        ]);

        MainQuestion::create($request->all());

        return redirect()->route('admin.main-questions.index')->with('success', 'Main Question created successfully.');
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
    public function edit(MainQuestion $mainQuestion)
    {
        $categories = Category::all();
        return view('admin.main_questions.edit', compact('mainQuestion', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MainQuestion $mainQuestion)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'question' => 'required|string',
            'weight' => 'nullable|numeric',
        ]);

        $mainQuestion->update($request->all());

        return redirect()->route('admin.main-questions.index')->with('success', 'Main Question updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MainQuestion $mainQuestion)
    {
        $mainQuestion->delete();

        return redirect()->route('admin.main-questions.index')->with('success', 'Main Question deleted successfully.');
    }
}
