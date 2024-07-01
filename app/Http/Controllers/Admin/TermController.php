<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Term;
use Illuminate\Http\Request;

class TermController extends Controller
{
    public function index()
    {
        $terms = Term::all();
        return view('admin.terms.index', compact('terms'));
    }

    public function create()
    {
        return view('admin.terms.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'ar_content' => 'required|string',
            'en_content' => 'required|string',
        ]);

        Term::create($request->all());

        return redirect()->route('terms.index')
            ->with('success', 'Term created successfully.');
    }

    public function show(Term $term)
    {
        return view('admin.terms.show', compact('term'));
    }

    public function edit(Term $term)
    {
        return view('admin.terms.edit', compact('term'));
    }

    public function update(Request $request, Term $term)
    {
        $request->validate([
            'ar_content' => 'required|string',
            'en_content' => 'required|string',
        ]);

        $term->update($request->all());

        return redirect()->route('terms.index')
            ->with('success', 'Term updated successfully.');
    }

    public function destroy(Term $term)
    {
        $term->delete();

        return redirect()->route('terms.index')
            ->with('success', 'Term deleted successfully.');
    }
}
