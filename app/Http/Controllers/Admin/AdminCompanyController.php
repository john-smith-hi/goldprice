<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;

class AdminCompanyController extends Controller
{
    /**
     * Display a listing of the companies.
     */
    public function index()
    {
        $companies = Company::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new company.
     */
    public function create()
    {
        return view('admin.companies.create');
    }

    /**
     * Store a newly created company in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'diachi' => 'nullable|string|max:255',
            'note' => 'nullable|string|max:255',
            'moreinfo' => 'nullable|string',
        ], [
            'name.required' => 'Tên công ty là bắt buộc',
            'name.max' => 'Tên công ty không được vượt quá 255 ký tự',
            'diachi.max' => 'Địa chỉ không được vượt quá 255 ký tự',
            'note.max' => 'Ghi chú không được vượt quá 255 ký tự',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            Company::create($request->all());
            return redirect()->route('admin.companies.index')
                ->with('success', 'Công ty đã được thêm thành công.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Có lỗi xảy ra khi thêm công ty: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Show the form for editing the specified company.
     */
    public function edit($id)
    {
        $company = Company::findOrFail($id);
        return view('admin.companies.edit', compact('company'));
    }

    /**
     * Update the specified company in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'diachi' => 'nullable|string|max:255',
            'note' => 'nullable|string|max:255',
            'moreinfo' => 'nullable|string',
        ], [
            'name.required' => 'Tên công ty là bắt buộc',
            'name.max' => 'Tên công ty không được vượt quá 255 ký tự',
            'diachi.max' => 'Địa chỉ không được vượt quá 255 ký tự',
            'note.max' => 'Ghi chú không được vượt quá 255 ký tự',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $company = Company::findOrFail($id);
            $company->update($request->all());
            return redirect()->route('admin.companies.index')
                ->with('success', 'Công ty đã được cập nhật thành công.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Có lỗi xảy ra khi cập nhật công ty: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified company from storage.
     */
    public function destroy($id)
    {
        try {
            $company = Company::findOrFail($id);
            $company->delete();
            return redirect()->route('admin.companies.index')
                ->with('success', 'Công ty đã được xóa thành công.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Có lỗi xảy ra khi xóa công ty: ' . $e->getMessage());
        }
    }

    /**
     * Restore the specified company from storage.
     */
    public function restore($id)
    {
        try {
            $company = Company::withTrashed()->findOrFail($id);
            $company->restore();
            return redirect()->route('admin.companies.index')
                ->with('success', 'Công ty đã được khôi phục thành công.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Có lỗi xảy ra khi khôi phục công ty: ' . $e->getMessage());
        }
    }
} 