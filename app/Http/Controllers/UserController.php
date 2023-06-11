<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::get();
        return view('user.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|unique:users',
        ]);

        return user::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make('user1234'),
        ]);

        // return redirect('/user/create')->with('status','Data Laporan Berhasil di Input');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = user::findOrfail($id);
        return view('user.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $current_password = $request->get('password');
        $new_password= $request->get('passwordbaru');
        
        if (!(Hash::check($current_password, Auth::user()->password))) {
            return redirect('/user')->with('status','Password salah')->with('class','alert-danger');
        }
        else{
            if ($current_password == $new_password) {
                return redirect('/user')->with('status','Password lama dan baru tidak boleh sama')->with('class','alert-danger');
            }else{
            user::find($id)->update([
                'name' => $request->get('name'),
                'password' => Hash::make($new_password)
            ]);
            }
        }


        return redirect('/user')->with('status','Data Laporan Berhasil di Ubah')->with('class','alert-success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('user.index');
    }
}
