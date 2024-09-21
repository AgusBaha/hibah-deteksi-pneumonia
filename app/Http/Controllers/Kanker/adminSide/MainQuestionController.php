<?php

namespace App\Http\Controllers\Kanker\adminSide;

use App\Http\Controllers\Controller;
use App\Models\Kanker\Category;
use App\Models\Kanker\MainQuestion;
use Illuminate\Http\Request;

class MainQuestionController extends Controller
{
    public function index()
    {
        $mainQuestions = MainQuestion::paginate(10);
        return view('kanker.admin.MainQuestion.index', compact('mainQuestions'));
    }

    public function create()
    {
        return view('kanker.admin.MainQuestion.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:255',
            'weight' => 'required|integer',
        ]);

        MainQuestion::create($request->all());
        return redirect()->route('main-questions.index')->with('success', 'Main question created successfully.');
    }

    public function edit(MainQuestion $mainQuestion)
    {
        return view('kanker.admin.MainQuestion.edit', compact('mainQuestion'));
    }

    public function update(Request $request, MainQuestion $mainQuestion)
    {
        $request->validate([
            'question' => 'required|string|max:255',
            'weight' => 'required|integer',
        ]);

        $mainQuestion->update($request->all());
        return redirect()->route('main-questions.index')->with('success', 'Main question updated successfully.');
    }

    public function destroy(MainQuestion $mainQuestion)
    {
        $mainQuestion->delete();
        return redirect()->route('main-questions.index')->with('success', 'Main question deleted successfully.');
    }
}
