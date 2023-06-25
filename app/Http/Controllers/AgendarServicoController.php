<?php

namespace App\Http\Controllers;

use App\Models\AgendarServico;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AgendarServicoController extends Controller
{
    public function store_service(Request $request){

        if(isset($request->add_apart)){
            $request->validate([
                'data_inicio' => 'required',
                'data_fim' => 'required',
                'servico_id' => 'required',
            ]);
            AgendarServico::updateOrCreate([
                'servico_id' => $request->servico_id,
                'apartamento_id' => $request->add_apart
            ],[
                'servico_id' => $request->servico_id,
                'apartamento_id' => $request->add_apart,
                'data_inicio' => $request->data_inicio,
                'data_fim' => $request->data_fim,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'how_created' => Auth::user()->id,
                'how_updated' => Auth::user()->id,
            ]);
        }

        if(isset($request->del_apart)){
            $request->validate([
                'servico_id' => 'required',
            ]);

            $agendar = AgendarServico::where([
                'servico_id' => $request->servico_id,
                'apartamento_id' => $request->del_apart
            ])->first();

            $agendar->delete();
        }

        return redirect()->back();

    }

}
