<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\lates;
use App\Models\rayons;
use App\Models\rombels;
use App\Models\students;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $student = students::all();
        $rayon = rayons::all();
        $rombel = rombels::all();
        if (Auth::user()-> role == 'ps') {

             $rayon_id = Auth::user()->rayon->id;

            $students = students::with('rayon')
                ->whereHas('rayon', function ($query) use ($rayon_id) {
                    $query->where('id', $rayon_id);
                })
                ->get();
        return view('Students.index', compact('rayon','rombel','student','students'));

        }
        return view('Students.index', compact('rayon','rombel','student'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rayon = rayons::all();
        $rombel = rombels::all();
        $student = students::all();
        return view('Students.create', compact('rayon','rombel','student'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nis' =>'required',
            'name'=> 'required',
            'rombel_id' => 'required',
            'rayon_id' => 'required'
        ]);

        students::create([
            'nis' => $request->nis,
            'name'=> $request->name,
            'rombel_id' => $request->rombel_id,
            'rayon_id' => $request->rayon_id
        ]);

        return redirect()->route('student.index')->with('success','data berhasil ditambahkan');

    }

    /**
     * Display the specified resource.
     */
    public function show(students $students)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(students $students, $id)
    {
        $student = students::find($id);
        $rombel = rombels::all();
        $rayon = rayons::all();
        return view('Students.edit', compact('rayon','rombel','student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, students $students, $id)
    {
        $request->validate([
            'nis'=>'required',
            'name'=>'required',
            'rombel_id'=>'required',
            'rayon_id'=>'required',
        ]);

        students::where('id', $id)->update([
            'nis'=>$request->nis,
            'name'=>$request->name,
            'rombel_id'=>$request->rombel_id,
            'rayon_id'=>$request->rayon_id,
        ]);

        return redirect()->route('student.index')->with('success','data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(students $students, $id)
    {
        Students::where('id', $id)->delete();
        return redirect()->back()->with('deleted','hapus data succes');
    }

    public function count()
    {
        if (Auth::user()-> role == 'admin') {
        $id = lates::all();
        $jmlStudent = students::count();
        $jmlRombel = rombels::count();
        $jmlRayon = rayons::count();
        $jmlAdmin = User::where('role', 'admin')->count();
        $jmlPs = User::where('role', 'ps')->count();
        return view('home', compact('jmlStudent','jmlRombel','jmlRayon','jmlAdmin','jmlPs'));
    }else{
        $userIdLogin = Auth::id();
        $rayon = rayons::where('user_id',$userIdLogin)->value('id');
        $tstudents = students::where('rayon_id', $rayon)->count();
        $tlates = students::where('rayon_id',$rayon)->with('lates')->get()->sum(function ($students){
            return $students->lates->count();
        });
        $today = students::where('rayon_id', $rayon)
        ->whereHas('lates', function ($query) {
            $query->whereDate('created_at', now()->toDateString());
        })
        ->count();
        return view('home', compact('tstudents', 'tlates','today','rayon'));
    }
}
}
