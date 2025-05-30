<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AccessLog;
use Illuminate\Http\Request;

class AdminAccessLogController extends Controller
{
    public function index()
    {
        $accessLogs = AccessLog::orderBy('id', 'desc')
            ->paginate(10);
        return view('admin.access_log', compact('accessLogs'));
    }

    public function create()
    {
        return view('admin.access_log_edit');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'ip_address' => 'required|string|max:45',
            'user_agent' => 'nullable|string',
            'device' => 'nullable|string|max:255',
            'resolution' => 'nullable|string|max:255',
            'language' => 'nullable|string|max:255',
            'url' => 'required|string|max:255',
        ]);

        AccessLog::create($validated);

        return redirect()->route('admin.access-logs.index')
            ->with('success', 'Log đã được thêm thành công');
    }

    public function edit(AccessLog $accessLog)
    {
        return view('admin.access_log_edit', compact('accessLog'));
    }

    public function update(Request $request, AccessLog $accessLog)
    {
        $validated = $request->validate([
            'ip_address' => 'required|string|max:45',
            'user_agent' => 'nullable|string',
            'device' => 'nullable|string|max:255',
            'resolution' => 'nullable|string|max:255',
            'language' => 'nullable|string|max:255',
            'url' => 'required|string|max:255',
        ]);

        $accessLog->update($validated);

        return redirect()->route('admin.access-logs.index')
            ->with('success', 'Log đã được cập nhật thành công');
    }

    public function destroy(AccessLog $accessLog)
    {
        try {
            $accessLog->delete();
            return response()->json([
                'success' => true,
                'message' => 'Log đã được xóa thành công'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra khi xóa log'
            ], 500);
        }
    }
} 