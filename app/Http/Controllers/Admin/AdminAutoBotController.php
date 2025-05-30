<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AutoBot;
use Illuminate\Http\Request;

class AdminAutoBotController extends Controller
{
    public function index()
    {
        $autoBots = AutoBot::withTrashed()
            ->orderBy('id', 'desc')
            ->paginate(10);
        return view('admin.auto_bot.index', compact('autoBots'));
    }

    public function create()
    {
        return view('admin.auto_bot_edit');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'url' => 'required|string|max:255',
            'request' => 'required|string|max:255',
            'status_response' => 'required|string|max:255',
            'response' => 'required|string',
        ]);

        AutoBot::create($validated);

        return redirect()->route('admin.auto-bots.index')
            ->with('success', 'Bot đã được thêm thành công');
    }

    public function edit(AutoBot $autoBot)
    {
        return view('admin.auto_bot_edit', compact('autoBot'));
    }

    public function update(Request $request, AutoBot $autoBot)
    {
        $validated = $request->validate([
            'url' => 'required|string|max:255',
            'request' => 'required|string|max:255',
            'status_response' => 'required|string|max:255',
            'response' => 'required|string',
        ]);

        $autoBot->update($validated);

        return redirect()->route('admin.auto-bots.index')
            ->with('success', 'Bot đã được cập nhật thành công');
    }

    public function destroy(AutoBot $autoBot)
    {
        try {
            $autoBot->delete();
            return response()->json([
                'success' => true,
                'message' => 'Bot đã được xóa thành công'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra khi xóa bot'
            ], 500);
        }
    }
} 