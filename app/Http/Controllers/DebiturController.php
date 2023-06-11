<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Debitur;
use Carbon\Carbon;
use Auth;
use DB;
use Excel;
use Illuminate\Support\Facades\Redirect;
use Spatie\FlareClient\View;

class DebiturController extends Controller
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
        $datas = Debitur::get();
        return view('debitur.index', compact('datas'));
    }


    // public function format()
    // {
    //     $data = [['rekening' => null, 'spk' => null, 'nama' => null, 'tunggakanbln' => null, 'angsuran' => null]];
    //         $fileName = 'format-buku';
            

    //     $export = Excel::download/Excel::store($fileName.date('Y-m-d_H-i-s'), function($excel) use($data){
    //         $excel->sheet('debitur', function($sheet) use($data) {
    //             $sheet->fromArray($data);
    //         });
    //     });

    //     return $export->download('xlsx');
        
    // }

    
    // public function formatdebitur(){
    //         return Excel::download(new DebiturExport(), 'formattgl.xlsx'); 
    // }


    // public function import(Request $request)
    // {
    //     excel::import(new DebiturImport,$request->file('importDebitur'));
        
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('debitur.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'rekening' => 'required|unique:debiturs,rekening',
            'spk' => 'required',
            'nama'=> 'required',
            'flafond' => 'required',
            'outstanding' => 'required',
            'tunggakanbln' => 'required',
            'jkw' => 'required',
            'angsuran' => 'required',
        ]);

        Debitur::create([        
            'rekening' => $request['rekening'],
            'spk' => $request['spk'],
            'nama'=> $request['nama'],
            'flafond' => $request['flafond'],
            'outstanding' => $request['outstanding'],
            'tunggakanbln' => $request['tunggakanbln'],
            'jkw' => $request['jkw'],
            'angsuran' => $request['angsuran'],
            'total_angsuran' => $request['total_angsuran'],
            'kecamatan' => $request['kecamatan'],
            'kelurahan' => $request['kelurahan']
        ]);

        return redirect(route('debitur.index'))->with('status','Data Debitur Berhasil di Input');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        debitur::find($id)->delete();
        return redirect()->route('debitur.index')->with('status','Data Laporan Berhasil di Hapus');
    }
}
