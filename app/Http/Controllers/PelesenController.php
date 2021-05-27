<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Models\SIS\Pelesen;
use App\Models\SIS\PelesenAttachment;

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
            $data = $request->except(['_token', 'attachment']);
            $data['user_id'] = Auth::user()->id;

            $pelesen = Pelesen::create($data);

            if($request->has('attachment')) {
                foreach($request->attachment as $attachment) {
                    $file = $attachment['file'];
                    $file_name = uniqid().'_'.preg_replace('/\+s/', '_', $file->getClientOriginalName());
                    $file->storeAs('public/attachment/', $file_name);

                    PelesenAttachment::create([
                        'pelesen_id' => $pelesen->id,
                        'title' => $attachment['title'],
                        'file_name' => $file_name
                    ]);
                }
            }

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

            if($request->has('attachment')) {
                foreach($request->attachment as $attachment) {
                    $file = $attachment['file'];
                    $file_name = uniqid().'_'.preg_replace('/\+s/', '_', $file->getClientOriginalName());
                    $file->storeAs('public/attachment/', $file_name);

                    PelesenAttachment::create([
                        'pelesen_id' => $pelesen->id,
                        'title' => $attachment['title'],
                        'file_name' => $file_name
                    ]);
                }
            }

            return redirect('pelesen')->with('success', 'Maklumat pelesen dikemaskini.');
        } catch(\Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function destroy(Pelesen $pelesen) {
        try {
            $pelesen->Attachments()->delete();
            $pelesen->delete();
            return response()->json(['status' => 'success', 'message' => 'Berjaya dipadam']);
        } catch(\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function deleteAttachment(PelesenAttachment $attachment) {
        try {
            if(file_exists(storage_path().'/app/public/attachment/'.$attachment->file_name)) {
                unlink(storage_path().'/app/public/attachment/'.$attachment->file_name);
            }
            $attachment->delete();
            return response()->json(['status' => 'success', 'Lampiran berjaya dipadam']);
        } catch(\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function getReport(Request $request) {
        $monthly = DB::select("select
            id,
            pelesen_id,
            date,
            month(date) month_date,
            year(date) year_date,
            left(date_format(date, '%M'), 3) month_name,
            date_format(date, '%y') year_short,
            sum(weight) total_weight,
            sum(total_payment) total_payment,
            sum(penalty) total_penalty
            from levi
            where pelesen_id = ".$request->input('pelesen_id')."
            and confirm_by is not null
            group by month(date), year(date)
            order by year(date), month(date);");

        $yearly = DB::select("select
            id,
            pelesen_id,
            date,
            month(date) month_date,
            year(date) year_date,
            left(date_format(date, '%M'), 3) month_name,
            date_format(date, '%y') year_short,
            sum(weight) total_weight,
            sum(total_payment) total_payment,
            sum(penalty) total_penalty
            from levi
            where pelesen_id = ".$request->input('pelesen_id')."
            and confirm_by is not null
            group by year(date)
            order by year(date);");

        return response()->json(['monthly' => $monthly, 'yearly' => $yearly]);
    }

}
