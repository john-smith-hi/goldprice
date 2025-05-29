<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;

class AdminFeedbackController extends Controller
{
    public function index()
    {
        $feedbacks = Feedback::withTrashed()
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('admin.feedback', compact('feedbacks'));
    }

    public function destroy($id)
    {
        try {
            $feedback = Feedback::findOrFail($id);
            $feedback->delete();
            return response()->json([
                'success' => true,
                'message' => 'Đã xóa phản hồi thành công'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra khi xóa phản hồi'
            ], 500);
        }
    }
} 