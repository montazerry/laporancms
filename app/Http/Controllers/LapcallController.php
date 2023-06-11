<?php

namespace App\Http\Controllers;

use App\Models\Code;
use App\Models\Debitur;
use App\Models\Lapcall;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LapcallController extends Controller
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
        if(Auth::user()->level == '2')
        {
            $datas = lapcall::where('user_id', Auth::user()->id)
                                ->get();
        } else {
            $datas = lapcall::get();
        }
        return view('lapcall.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->level == '2')
        {
            $users = User::where('id', Auth::user()->id)
                                ->get();
        } else {
            $users = User::get();
        }
        $codes = Code::get();
        $debiturs = Debitur::get();
        return view('lapcall.create',compact('debiturs','codes','users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'laporan' => 'required'
        ]);
        
        lapcall::create([
            'user_id' => $request->get('user_id'),
            'debitur_id' => $request->get('debitur_id'),
            'debitur_rekening' => $request->get('rekening'),
            'code_id' => $request->get('code_id'),
            'tanggal' => $request->get('tanggal'),
            'tanggal_janji' => $request->get('tanggal_janji'),
            'laporan' => $request->get('laporan')
        ]);

        return redirect('/lapcall/create')->with('status','Data Laporan Berhasil di Input');

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
        $codes = Code::get();
        // $debiturs = Debitur::get();
        $data = lapcall::findOrFail($id);
        return view('lapcall.edit', compact('data','codes'));
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
        lapcall::find($id)->update([
            'user_id' => $request->get('user_id'),
            'debitur_id' => $request->get('debitur_id'),
            'tanggal' => $request->get('tanggal'),
            'code_id' => $request->get('code_id'),
            'tanggal_janji' => $request->get('tanggal_janji'),
            'laporan' => $request->get('laporan')
        ]);

        return redirect('/lapcall')->with('status','Data Laporan Berhasil di Ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        lapcall::find($id)->delete();
        return redirect()->route('lapcall.index');
    }
}
