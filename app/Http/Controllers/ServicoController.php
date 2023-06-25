<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServicoRequest;
use App\Models\Apartamento;
use App\Models\Servico;
use App\Utils\AlertMessage;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServicoController extends Controller
{
    public function index(Request $request)
    {
        $panel = "servico";
        $servicos = Servico::orderBy('id', 'DESC')->paginate();
        if(isset($request->reclamacao)){
            $reclamacao = "existo";
            $panel = "reclamacao_servico";
            return view('page.servico', compact('servicos', 'panel','reclamacao'));
        }
        return view('page.servico', compact('servicos', 'panel'));
    }

    public function store(ServicoRequest $request)
    {
        try {
            $servico = Servico::create($request->all());
            $servico->registerServico(Auth::user()->id);
            $alertMessage = AlertMessage::CREATE();
            toastr()->success($alertMessage->message, $alertMessage->type);
        } catch (Exception $e) {
            dd($e);
            $alertMessage = AlertMessage::DANGER();
            toastr()->error($alertMessage->message, $alertMessage->type);
        } finally {
            return redirect()->route('servico.home');
        }
    }

    public function update(ServicoRequest $request, $id)
    {
        try {
            $servico = Servico::find($id);
            $servico->update($request->all());
            $servico->registerServicoUpdate(Auth::user()->id);
            $alertMessage = AlertMessage::WARNING();
        } catch (Exception) {
            $alertMessage = AlertMessage::DANGER();
        }
        return redirect()->route('servico.home')
            ->with($alertMessage->type, $alertMessage->message);
    }

    public function delete($id)
    {
        try {
            $servico = Servico::find($id);
            $servico->delete();
            $alertMessage = AlertMessage::SUCCESS();
        } catch (Exception) {
            $alertMessage = AlertMessage::DANGER();
        } finally {
            return redirect()->route('servico.home')
                ->with($alertMessage->type, $alertMessage->message);
        }
    }

    public function search(Request $request)
    {
        $panel = "servico";
        $field = strtolower($request->field);
        $search = htmlspecialchars($request->search);
        $servicos = Servico::where($field, 'like', '%' . $search . '%')
            ->orderBy('id', 'DESC')
            ->paginate();
        return view('page.servico', compact('servicos', 'panel'));
    }

    public function apartamento(Request $request,$action, $servico_id)
    {
        $panel = "servico";
        $servico = Servico::find($servico_id);
        $apartamentos = Apartamento::orderBy('id', 'DESC');
        if ($action == "list") {
            $apartamentos = $apartamentos->join('agendar_servicos', 'apartamento_id', 'apartamentos.id')
                ->select('apartamentos.*', 'data_inicio', 'data_fim');
        }

        $apartamentos = $apartamentos->paginate();

        return view('page.servico.apartamento', compact('apartamentos', 'panel', 'servico', 'action'));
    }

    public function apartamento_search(Request $request, $action, $servico_id)
    {
        $panel = "servico";
        $field = strtolower($request->field);
        $search = htmlspecialchars($request->search);
        $servico = Servico::find($servico_id);
        $apartamentos = Apartamento::where($field, 'like', '%' . $search . '%')->orderBy('id', 'DESC');
        if ($action == "list") {
            $apartamentos = $apartamentos->join('agendar_servicos', 'apartamento_id', 'apartamentos.id')
                ->select('apartamentos.*', 'data_inicio', 'data_fim');
        }
        $apartamentos = $apartamentos->paginate();

        return view('page.servico.apartamento', compact('apartamentos', 'panel', 'servico', 'action'));
    }
}
