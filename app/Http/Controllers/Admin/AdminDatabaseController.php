<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDatabaseController extends Controller
{
    public function index()
    {
        return view('admin.database');
    }

    public function executeQuery(Request $request)
    {
        $request->validate([
            'query' => 'required|string'
        ]);

        try {
            $query = $request->input('query');
            $result = DB::select($query);
            return response()->json([
                'success' => true,
                'data' => $result
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}