<?php

namespace App\Http\Controllers;

use App\Models\Apartamento;
use App\Models\ReclamacaoServico;
use App\Models\Servico;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReclamacaoServicoController extends Controller
{
    public function apartamento(Request $request,$action, $servico_id){
        $panel = "servico";
        $servico = Servico::find($servico_id);
        $apartamentos = Apartamento::orderBy('id','DESC');
        if($action == "list"){
            $apartamentos = $apartamentos->join('reclamacao_servicos','apartamento_id','apartamentos.id')
            ->select('apartamentos.*','motivo','reclamacao_servicos.descricao as desc');
        }

        $apartamentos = $apartamentos->paginate();
        if(isset($request->reclamacao)){
            $reclamacao = "existo";
            $panel = "reclamacao_servico";
            return view('page.servico.apartamento_reclamacao',compact('apartamentos','panel','servico','action','reclamacao'));
        }
        return view('page.servico.apartamento_reclamacao',compact('apartamentos','panel','servico','action'));
    }

    public function apartamento_search(Request $request, $action, $servico_id){
        $panel = "servico";
        $field = strtolower($request->field);
        $search =htmlspecialchars($request->search);
        $servico = Servico::find($servico_id);
        $apartamentos = Apartamento::where("apartamentos.{$field}",'like','%'.$search.'%')->orderBy('id','DESC');

        if($action == "list"){
            $apartamentos = $apartamentos->join('reclamacao_servicos','apartamento_id','apartamentos.id')
                                        ->select('apartamentos.*','motivo','reclamacao_servicos.descricao as desc');
        }

        $apartamentos  = $apartamentos->paginate();
        if(isset($request->reclamacao)){
            $reclamacao = "existo";
            $panel = "reclamacao_servico";
            return view('page.servico.apartamento_reclamacao',compact('apartamentos','panel','servico','action','reclamacao'));
        }
        return view('page.servico.apartamento_reclamacao',compact('apartamentos','panel','servico','action'));
    }

    public function store_service(Request $request){

        if(isset($request->add_apart)){
            $request->validate([
                'motivo' => 'required',
                'descricao' => 'required',
                'servico_id' => 'required',
            ]);
            ReclamacaoServico::updateOrCreate([
                'servico_id' => $request->servico_id,
                'apartamento_id' => $request->add_apart
            ],[
                'servico_id' => $request->servico_id,
                'apartamento_id' => $request->add_apart,
                'motivo' => $request->motivo,
                'descricao' => $request->descricao,
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

            $agendar = ReclamacaoServico::where([
                'servico_id' => $request->servico_id,
                'apartamento_id' => $request->del_apart
            ])->first();

            $agendar->delete();
        }

        return redirect()->back();

    }

}
