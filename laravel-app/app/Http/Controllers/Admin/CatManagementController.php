<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cat;
use Illuminate\Http\Request;

class CatManagementController extends Controller
{
    public function index()
    {
        $cats = Cat::paginate(15);
        return view('admin.cats.index', compact('cats'));
    }

    public function create()
    {
        return view('admin.cats.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'breed' => 'required|string|max:255',
            'age' => 'required|integer|min:0',
            'status' => 'required|in:Available,Adopted,Lost',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('cats', 'public');
        }

        Cat::create($validated);

        return redirect()->route('admin.cats.index')->with('success', 'Cat created successfully.');
    }

    public function edit(Cat $cat)
    {
        return view('admin.cats.edit', compact('cat'));
    }

    public function update(Request $request, Cat $cat)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'breed' => 'required|string|max:255',
            'age' => 'required|integer|min:0',
            'status' => 'required|in:Available,Adopted,Lost',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('cats', 'public');
        }

        $cat->update($validated);

        return redirect()->route('admin.cats.index')->with('success', 'Cat updated successfully.');
    }

    public function destroy(Cat $cat)
    {
        $cat->delete();
        return redirect()->route('admin.cats.index')->with('success', 'Cat deleted successfully.');
    }
}
