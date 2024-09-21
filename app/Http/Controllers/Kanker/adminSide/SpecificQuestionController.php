<?php

namespace App\Http\Controllers\Kanker\adminSide;

use App\Http\Controllers\Controller;
use App\Models\Kanker\Category;
use App\Models\Kanker\MainQuestion;
use App\Models\Kanker\SpecificQuestion;
use Illuminate\Http\Request;

class SpecificQuestionController extends Controller
{
    public function index()
    {
        $specificQuestions = SpecificQuestion::with('category')->paginate(10);
        return view('kanker.admin.SpecificQuestions.index', compact('specificQuestions'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('kanker.admin.SpecificQuestions.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'question' => 'required|string|max:255',
            'weight' => 'required|integer',
        ]);

        SpecificQuestion::create($request->all());
        return redirect()->route('specific-questions.index')->with('success', 'Specific question created successfully.');
    }

    public function edit(SpecificQuestion $specificQuestion)
    {
        $categories = Category::all();
        return view('kanker.admin.SpecificQuestions.edit', compact('specificQuestion', 'categories'));
    }

    public function update(Request $request, SpecificQuestion $specificQuestion)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'question' => 'required|string|max:255',
            'weight' => 'required|integer',
        ]);

        $specificQuestion->update($request->all());
        return redirect()->route('specific-questions.index')->with('success', 'Specific question updated successfully.');
    }

    public function destroy(SpecificQuestion $specificQuestion)
    {
        $specificQuestion->delete();
        return redirect()->route('specific-questions.index')->with('success', 'Specific question deleted successfully.');
    }
}
