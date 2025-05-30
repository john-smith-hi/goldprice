<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use Illuminate\Http\Request;

class AdminCurrencyController extends Controller
{
    public function index()
    {
        $currencies = Currency::withTrashed()
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('admin.currencies.index', compact('currencies'));
    }

    public function create()
    {
        return view('admin.currencies.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'source' => 'required|string|max:255',
            'target' => 'required|string|max:255',
            'number_source' => 'required|numeric|min:0',
            'number_target' => 'required|numeric|min:0',
            'datetime' => 'required|date',
            'time' => 'nullable|integer',
        ]);

        Currency::create($validated);

        return redirect()->route('admin.currencies.index')
            ->with('success', 'Tỷ giá đã được thêm thành công');
    }

    public function edit(Currency $currency)
    {
        return view('admin.currencies.edit', compact('currency'));
    }

    public function update(Request $request, Currency $currency)
    {
        $validated = $request->validate([
            'source' => 'required|string|max:255',
            'target' => 'required|string|max:255',
            'number_source' => 'required|numeric|min:0',
            'number_target' => 'required|numeric|min:0',
            'datetime' => 'required|date',
            'time' => 'nullable|integer',
        ]);

        $currency->update($validated);

        return redirect()->route('admin.currencies.index')
            ->with('success', 'Tỷ giá đã được cập nhật thành công');
    }

    public function destroy(Currency $currency)
    {
        try {
            $currency->delete();
            return response()->json([
                'success' => true,
                'message' => 'Tỷ giá đã được xóa thành công'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra khi xóa tỷ giá'
            ], 500);
        }
    }
} 