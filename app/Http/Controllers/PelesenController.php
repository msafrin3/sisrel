<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Models\SIS\Pelesen;

class PelesenController extends Controller
{
    
    public function index() {
        $pelesens = Pelesen::orderBy('company_name')->get();
        return view('pelesen.index', ['pelesens' => $pelesens]);
    }

    public function create() {
        return view('pelesen.add');
    }

    public function store(Request $request) {
        try {
            $data = $request->except(['_token']);
            $data['user_id'] = Auth::user()->id;
            Pelesen::create($data);

            return redirect('pelesen')->with('success', 'Pelesen baru berjaya didaftarkan.');
        } catch(\Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function show(Pelesen $pelesen) {
        return view('pelesen.show', ['pelesen' => $pelesen]);
    }

    public function edit(Pelesen $pelesen) {
        return view('pelesen.edit', ['pelesen' => $pelesen]);
    }

    public function update(Request $request, Pelesen $pelesen) {
        try {
            $data = $request->except(['_token']);
            $data['user_id'] = Auth::user()->id;
            $pelesen->update($data);

            return redirect('pelesen')->with('success', 'Maklumat pelesen dikemaskini.');
        } catch(\Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function destroy(Pelesen $pelesen) {
        try {
            
        } catch(\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

}
