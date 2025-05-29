<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;

class AdminFeedbackController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('check.fkey');
    }

    public function index()
    {
        $feedbacks = Feedback::withTrashed()
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('admin.feedback', compact('feedbacks'));
    }

    public function destroy(Feedback $feedback)
    {
        try {
            $feedback->delete();
            return redirect()->route('admin.feedback')
                ->with('success', 'Đã xóa phản hồi thành công');
        } catch (\Exception $e) {
            return redirect()->route('admin.feedback')
                ->with('error', 'Có lỗi xảy ra khi xóa phản hồi');
        }
    }
} 