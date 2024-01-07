<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::all();
        return view('Users.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'role' => 'required',
        ]);

        $emailPrefix = substr($request->email, 0, 3);
        $namePrefix = substr($request->name, 0, 3);
        $generatedPassword = $emailPrefix . $namePrefix;

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($generatedPassword),
            'role' => $request->role,
        ]);

        return redirect()->route('user.index')->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(user $users)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $users, $id)
    {
        $users = User::all();
        $user = User::find($id);
        return view('Users.edit', compact('user', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $users, $id)
    {

        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'role'=>'required',
        ]);

        $DataUser = [
            'name' =>$request->name,
            'email' =>$request->email,
            'role' =>$request->role,
        ];

        if($request->filled('password')){
            $DataUser['password'] = bcrypt($request->password);
        } 

        User::where('id', $id)->update($DataUser);

        return redirect()->route('user.index')->with('success','data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $users, $id)
    {
        User::where('id',$id)->delete();
        return redirect()->back()->with('deleted','hapus data succes');
    }

    public function loginAuth(Request $request){
        $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required'
        ],
        [
            'email.required' => 'Email harus diisi',
            'email.email' => 'Email tidak valid',
            'password.required' => 'Password harus diisi',
            'password.alpha_dash' => 'Password harus berisi huruf dan karakter tanpa spasi',
            'password.password' => 'Password tidak valid',
        ]
        );

        $user = $request->only(['email', 'password']);

        if (Auth::attempt($user)){
            return redirect()->route('home');
        } else {
            return redirect()->back()->with('failed', "Login Process Failed, Please Try Again With The Correct Data");
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login')->with('logout', 'Logout Successful');
    }

}
