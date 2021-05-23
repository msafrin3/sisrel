<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\User;
use App\Models\SIS\Levi;
use App\Models\SIS\Pelesen;

class LeviController extends Controller
{
    
    public function index() {
        $levis = Levi::orderBy('created_at')->get();
        return view('levi.index', ['levis' => $levis]);
    }

    public function create() {
        $pelesens = Pelesen::orderBy('company_name')->get();
        return view('levi.add', ['pelesens' => $pelesens]);
    }

    public function store(Request $request) {
        try {
            $data = $request->except(['_token']);
            $data['user_id'] = Auth::user()->id;
            Levi::create($data);
            return redirect('levi')->with('success', 'Maklumate levi disimpan.');
        } catch(\Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function show(Levi $levi) {
        return view('levi.show', ['levi' => $levi]);
    }

    public function edit(Levi $levi) {
        $pelesens = Pelesen::orderBy('company_name')->get();
        return view('levi.edit', ['levi' => $levi, 'pelesens' => $pelesens]);
    }

    public function update(Request $request, Levi $levi) {
        try {
            $data = $request->except(['_token']);
            $data['user_id'] = Auth::user()->id;
            $levi->update($data);
            return redirect('levi')->with('success', 'Maklumat levi dikemaskini.');
        } catch(\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function getRunningNumber(Request $request) {
        $date = $request->input('date');
        $number = '';
        $data = Levi::whereYear('date', date('Y', strtotime($date)))->whereMonth('date', date('m', strtotime($date)))->orderBy('date', 'desc');
        if($data->count() == 0) {
            $number = 500001;
        } else {
            $data = $data->get();
            $number = $data[0]->registration_no + 1;
        }

        return $number;
    }

    public function destroy(Levi $levi) {

    }

}
