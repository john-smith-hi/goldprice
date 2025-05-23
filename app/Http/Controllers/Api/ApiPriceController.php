<?php

namespace App\Http\Controllers\Api;

use App\Models\Price;
use Illuminate\Support\Facades\Validator;

class ApiPriceController
    {
    public function index()
    {
        $validator = Validator::make(request()->all(), [
            'type'         => 'nullable|integer',
            'time_filter'  => 'required|in:lastest,day,week,month,quarter,year,custom',
            'from_date'    => 'nullable|date_format:d/m/Y',
            'to_date'      => 'nullable|date_format:d/m/Y',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $type        = request('type');
        $time_filter = request('time_filter');
        $from_date   = request('from_date');
        $to_date     = request('to_date');

        $prices = (new Price())->getGoldPrice($time_filter, $type, $from_date, $to_date);

        return response()->json([
            'success' => true,
            'data' => $prices,
        ]);
    }

}
