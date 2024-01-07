<?php

namespace App\Http\Controllers;

use PDF;
use Excel;
use App\Models\lates;
use App\Models\rayons;
use App\Models\students;
use App\Exports\LatesExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LatesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lates = lates::all();
        $students = students::all();

        if (Auth::user()-> role == 'ps') {
        $rayon = rayons::where('user_id', Auth::user()->id)->first();

         $lates = lates::with('students')
            ->whereHas('students', function ($query) use ($rayon) {
                $query->where('rayon_id', $rayon->id);
        })->get();

    return view('Lates.index', compact('lates'));
        }
        return view('Lates.index', compact('students','lates'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $lates = lates::all();
        $student = students::all();
        return view('Lates.create', compact('lates','student'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $request->validate([
            'student_id' => 'required',
            'date_time_late' =>'required',
            'information'=> 'required',
            'bukti' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5000',
        ]);

        // if ($request->file('image')) {
        //     $validate['image'] = $request->file('image')->store('post-image');
        // }

        $data = $request->all();

        if ($request->hasFile('bukti')) {
           $file = $request->file('bukti');
           $filename = $file->hashName();
           $file->storeAs('images', $filename, 'public');
           $data['bukti'] = $filename;
        }

        $data['student_id'] = $request->student_id;

        lates::create($data);

        return redirect()->route('lates.index')->with('success','data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(lates $lates)
    {
        $lates = lates::all();
        $students = students::all();
        if (Auth::user()-> role == 'ps') {
            $rayon = rayons::where('user_id', Auth::user()->id)->first();

             $late = lates::with('students')
                ->whereHas('students', function ($query) use ($rayon) {
                    $query->where('rayon_id', $rayon->id);
            })->get();

        return view('Lates.rekap', compact('students','lates','late'));
            }
        return view('Lates.rekap', compact('students','lates'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(lates $lates, $id)
    {
        $lates = lates::find($id);
        $student = students::all();
        return view('Lates.edit', compact('lates','student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, lates $lates, $id)
    {

        $request->validate([
            'student_id'=>'required',
            'information'=> 'required',
            'bukti' => 'required',
        ]);

        lates::where('id', $id)->update([
            'student_id'=>$request->student_id,
            'information'=>$request->information,
            'bukti'=>$request->bukti,
        ]);
        return redirect()->route('lates.index')->with('success','data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(lates $lates, $id)
    {
        lates::where('id', $id)->delete();
        return redirect()->back()->with('deleted','hapus data succes');
    }

    public function downloadPDF($student_id) {
        if (Auth::user()-> role == 'ps') {
            $lates = lates::with('students')->find($student_id);
            $pdf = PDF::loadView('Lates.print', compact('lates'));
            $pdfFileName = 'terlambat_' . $lates->id . '.pdf';
            // Mendownload file PDF langsung
            return $pdf->stream($pdfFileName);
        }
        $student = students::with('rombel', 'rayon')->find($student_id);
        $pdf = PDF::loadView('Lates.print', compact('student'));
        $pdfFileName = 'terlambat_' . $student->name . '.pdf';
        // Mendownload file PDF langsung
        return $pdf->stream($pdfFileName);
    }

    public function exportExcel(){

        $file_name = 'data_keterlambatan'.'.xlsx';
        return Excel::download(new LatesExport, $file_name);
    }

    public function lihat($student_id)
    {        if (Auth::user()-> role == 'ps') {
        $rayon = rayons::where('user_id', Auth::user()->id)->first();
         $lates = lates::find($student_id);
        //  dd($lates);
         return view('Lates.detail', compact('lates'));
        }

        $students = students::find($student_id);
        $lates = lates::where('student_id',$student_id)->get();
        return view('Lates.detail', compact('students','lates'));
    }
}
