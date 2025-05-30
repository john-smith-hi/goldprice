<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Price;
use App\Models\TypeGold;
use Illuminate\Http\Request;

class AdminPriceController extends Controller
{
    public function index(Request $request)
    {
        $query = Price::with(['typeGold.company'])
            ->withTrashed()
            ->orderBy('prices.created_at', 'desc');

        if ($request->has('search') && $request->input('search') != '') {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('price_in', 'like', '%' . $search . '%')
                  ->orWhere('price_out', 'like', '%' . $search . '%')
                  ->orWhere('url', 'like', '%' . $search . '%')
                  ->orWhereHas('typeGold', function ($q) use ($search) {
                      $q->where('name_vn', 'like', '%' . $search . '%')
                        ->orWhere('name_en', 'like', '%' . $search . '%')
                        ->orWhere('note', 'like', '%' . $search . '%')
                        ->orWhereHas('company', function ($q) use ($search) {
                            $q->where('name', 'like', '%' . $search . '%');
                        });
                  });
            });
        }

        $prices = $query->paginate(10);

        return view('admin.prices.index', compact('prices'));
    }

    public function create()
    {
        $typeGolds = TypeGold::all();
        return view('admin.prices.create', compact('typeGolds'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'price_in' => 'required|numeric|min:0',
            'price_out' => 'required|numeric|min:0',
            'type' => 'required|exists:type_gold,id',
            'url' => 'required|string|max:500',
            'published_at' => 'nullable|date',
        ]);

        Price::create($validated);

        return redirect()->route('admin.prices.index')
            ->with('success', 'Giá vàng đã được thêm thành công');
    }

    public function edit(Price $price)
    {
        $types = TypeGold::all();
        return view('admin.price_edit', compact('price', 'types'));
    }

    public function update(Request $request, Price $price)
    {
        $validated = $request->validate([
            'price_in' => 'required|numeric|min:0',
            'price_out' => 'required|numeric|min:0',
            'type' => 'required|exists:type_gold,id',
            'url' => 'required|string|max:500',
            'published_at' => 'nullable|date',
        ]);

        $price->update($validated);

        return redirect()->route('admin.prices.index')
            ->with('success', 'Giá vàng đã được cập nhật thành công');
    }

    public function destroy(Price $price)
    {
        try {
            $price->delete();
            return response()->json([
                'success' => true,
                'message' => 'Giá vàng đã được xóa thành công'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra khi xóa giá vàng'
            ], 500);
        }
    }

    public function show(Price $price)
    {
        return view('admin.prices.show', compact('price'));
    }
} 