<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CatManagementController extends Controller
{
    public function index(Request $request)
    {
        $query = Cat::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->input('search') . '%');
        }

        if ($request->filled('breed')) {
            if ($request->input('breed') === 'unknown') {
                $query->where(fn($q) => $q->whereNull('breed')->orWhere('breed', ''));
            } else {
                $query->where('breed', $request->input('breed'));
            }
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        if ($request->filled('age')) {
            match($request->input('age')) {
                'unknown' => $query->whereNull('age'),
                'kitten'  => $query->where('age', '<', 1),
                'young'   => $query->whereBetween('age', [1, 3]),
                'adult'   => $query->whereBetween('age', [4, 7]),
                'senior'  => $query->where('age', '>=', 8),
                default   => null,
            };
        }

        $cats   = $query->paginate(15)->withQueryString();
        $breeds = Cat::whereNotNull('breed')->distinct()->orderBy('breed')->pluck('breed');

        return view('admin.cats.index', compact('cats', 'breeds'));
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

    public function show(Cat $cat)
    {
        return view('admin.cats.show', compact('cat'));
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
            if ($cat->image) {
                Storage::disk('public')->delete($cat->image);
            }
            $validated['image'] = $request->file('image')->store('cats', 'public');
        }

        $cat->update($validated);

        return redirect()->route('admin.cats.index')->with('success', 'Cat updated successfully.');
    }

    public function updateFields(Request $request, Cat $cat)
    {
        $validated = $request->validate([
            'name'          => 'nullable|string|max:255',
            'breed'         => 'nullable|string|max:255',
            'gender'        => 'nullable|string|max:50',
            'age'           => 'nullable|integer|min:0',
            'color'         => 'nullable|string|max:255',
            'weight'        => 'nullable|numeric|min:0',
            'status'        => 'nullable|in:Available,Adopted,Lost',
            'gps_lat'       => 'nullable|numeric|between:-90,90',
            'gps_lng'       => 'nullable|numeric|between:-180,180',
            'location_name'   => 'nullable|string|max:255',
            'description'     => 'nullable|string',
            'medical_history' => 'nullable|string',
        ]);

        $cat->update(array_filter($validated, fn($v) => $v !== null && $v !== ''));

        return response()->json(['success' => true, 'cat' => $cat->fresh()]);
    }

    public function destroy(Cat $cat)
    {
        $cat->delete();
        return redirect()->route('admin.cats.index')->with('success', 'Cat deleted successfully.');
    }
}
