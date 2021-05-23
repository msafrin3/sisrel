<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Models\SIS\Levi;
use App\Models\SIS\Pelesen;

class ReportController extends Controller
{
    
    public function index(Request $request) {
        $data = new Levi();
        $data = $request->input('year') ? $data->whereYear('date', $request->input('year'))->whereMonth('date', $request->input('month'))->where('payment_at', '!=', null) : $data;
        $data = $data->orderBy('created_at')->get();
        
        return view('report.index', ['data' => $data]);
    }

}
