<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Lapcall;
use App\models\Debitur;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $date = Carbon::now()->format('m');
        if(Auth::user()->level == '2')
        {
            $lapcall = Lapcall::where('user_id',Auth::user()->id)
                                ->whereMonth('tanggal',$date)
                                ->get();
            $debitur = Debitur::get();
        } else {
            $lapcall = Lapcall::whereMonth('tanggal',$date)->get();
            $debitur = debitur::get();
        }
        

        return view('index',compact('lapcall','debitur','date'));
    }

    public function filter(Request $request){

        if ($request->ajax()) {
            $output = '';
            $query = $request->get('query');
            if ($query != '') {
                $data = lapcall::where('code_id','LIKE',$query)
                                ->orWhere('laporan', 'like', '%'.$query.'%')
                                ->get();
            }else{
                $data = lapcall::get(); 
            }
            $total_row = $data->count();
            if ($total_row > 0) {
                foreach($data as $row){
                $output .= '
              <tr>
                
                <th>'.$row->debitur['rekening'].'</th>
                <th>'.$row->debitur['nama'].'</th>
                <td>'.$row->debitur['spk'].'</td>
                <td>'.$row->code['riskcode'].'</td>
                <td>'.$row->laporan.'</td>
              </tr>
                ';
            }
            }else{
                $output= '
                    <tr>
                        <td colspan="5">Data Tidak Ditemukan</td>
                    </tr>
                ';
            }
            $data = array(
                'table_data' => $output,
                'total_data' => $total_data
            );

            echo json_encode($data);
        }
    }
}
