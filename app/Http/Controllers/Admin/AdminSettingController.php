<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AdminSettingController extends Controller
{
    /**
     * Display a listing of the settings.
     */
    public function index()
    {
        $settings = Setting::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.settings.index', compact('settings'));
    }

    /**
     * Show the form for creating a new setting.
     */
    public function create()
    {
        return view('admin.settings.create');
    }

    /**
     * Store a newly created setting in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:settings,name',
            'type_value' => 'required|string|max:255',
            'value' => 'required|string|max:255',
            'note' => 'required|string|max:255',
        ], [
            'name.required' => 'Tên cài đặt là bắt buộc',
            'name.unique' => 'Tên cài đặt này đã tồn tại',
            'type_value.required' => 'Loại giá trị là bắt buộc',
            'value.required' => 'Giá trị là bắt buộc',
            'note.required' => 'Ghi chú là bắt buộc',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            Setting::create($request->all());
            return redirect()->route('admin.settings.index')
                ->with('success', 'Cài đặt đã được thêm thành công.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Có lỗi xảy ra khi thêm cài đặt: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Show the form for editing the specified setting.
     */
    public function edit($id)
    {
        $setting = Setting::findOrFail($id);
        return view('admin.settings.edit', compact('setting'));
    }

    /**
     * Update the specified setting in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:settings,name,' . $id,
            'type_value' => 'required|string|max:255',
            'value' => 'required|string|max:255',
            'note' => 'required|string|max:255',
        ], [
            'name.required' => 'Tên cài đặt là bắt buộc',
            'name.unique' => 'Tên cài đặt này đã tồn tại',
            'type_value.required' => 'Loại giá trị là bắt buộc',
            'value.required' => 'Giá trị là bắt buộc',
            'note.required' => 'Ghi chú là bắt buộc',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $setting = Setting::findOrFail($id);
            $setting->update($request->all());
            return redirect()->route('admin.settings.index')
                ->with('success', 'Cài đặt đã được cập nhật thành công.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Có lỗi xảy ra khi cập nhật cài đặt: ' . $e->getMessage())
                ->withInput();
        }
    }
} 