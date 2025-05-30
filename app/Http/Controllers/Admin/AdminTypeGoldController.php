<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TypeGold;
use App\Models\Company;
use Illuminate\Http\Request;

class AdminTypeGoldController extends Controller
{
    public function index()
    {
        $typeGolds = TypeGold::with(['company'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('admin.type_gold.index', compact('typeGolds'));
    }

    public function create()
    {
        $companies = Company::all();
        return view('admin.type_gold.create', compact('companies'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'companies_id' => 'required|exists:companies,id',
            'name_vn' => 'required|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'note' => 'nullable|string|max:255',
            'type' => 'required|integer|in:0,1',
        ]);

        TypeGold::create($validated);

        return redirect()->route('admin.type-gold.index')
            ->with('success', 'Loại vàng đã được thêm thành công');
    }

    public function edit(TypeGold $typeGold)
    {
        $companies = Company::all();
        return view('admin.type_gold.edit', compact('typeGold', 'companies'));
    }

    public function update(Request $request, TypeGold $typeGold)
    {
        $validated = $request->validate([
            'companies_id' => 'required|exists:companies,id',
            'name_vn' => 'required|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'note' => 'nullable|string|max:255',
            'type' => 'required|integer|in:0,1',
        ]);

        $typeGold->update($validated);

        return redirect()->route('admin.type-gold.index')
            ->with('success', 'Loại vàng đã được cập nhật thành công');
    }
} 