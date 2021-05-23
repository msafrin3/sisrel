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
        return view('report.index');
    }

}
