<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mews\Captcha\Facades\Captcha;

class FeedbackController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'message' => 'required|string',
            'captcha' => 'required|captcha'
        ], [
            'name.required' => 'Vui lòng nhập họ và tên',
            'name.max' => 'Họ và tên không được vượt quá 255 ký tự',
            'email.email' => 'Email không hợp lệ',
            'message.required' => 'Vui lòng nhập nội dung góp ý',
            'captcha.required' => 'Vui lòng nhập mã xác nhận',
            'captcha.captcha' => 'Mã xác nhận không chính xác. Vui lòng thử lại.'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first()
            ], 422);
        }

        Feedback::create([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Cảm ơn bạn đã gửi phản hồi!'
        ]);
    }

    public function refreshCaptcha()
    {
        return response()->json(['captcha' => Captcha::img()]);
    }
}