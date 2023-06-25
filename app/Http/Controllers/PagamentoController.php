<?php

namespace App\Http\Controllers;

use App\Http\Requests\PagamentoRequest;
use App\Models\Pagamento;
use App\Utils\AlertMessage;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PagamentoController extends Controller
{
    public function index(){
        $panel = "pagamento";
        $pagamentos = Pagamento::orderBy('id','DESC')->paginate();
        return view('page.pagamento',compact('pagamentos','panel'));
    }

    public function store(PagamentoRequest $request){
        try{
            $pagamento = Pagamento::create($request->all());
            $pagamento->registerUser(Auth::user()->id);
            $alertMessage = AlertMessage::CREATE();
            toastr()->success($alertMessage->message,$alertMessage->type);
        }catch(Exception){
            $alertMessage = AlertMessage::DANGER();
            toastr()->error($alertMessage->message,$alertMessage->type);
        }finally{
            return redirect()->route('pagamento.home');
        }
    }

    public function update(pagamentoRequest $request,$id){
        try{
            $pagamento = Pagamento::find($id);
            $pagamento->update($request->all());
            $pagamento->registerUserUpdate(Auth::user()->id);
            $alertMessage = AlertMessage::WARNING();
        }catch(Exception){
            $alertMessage = AlertMessage::DANGER();
        }finally{
            return redirect()->route('pagamento.home')
                             ->with($alertMessage->type,$alertMessage->message);
        }
    }

    public function delete($id){
        try{
            $pagamento = Pagamento::find($id);
            $pagamento->delete();
            $alertMessage = AlertMessage::SUCCESS();
        }catch(Exception){
            $alertMessage = AlertMessage::DANGER();
        }finally{
            return redirect()->route('pagamento.home')
                             ->with($alertMessage->type,$alertMessage->message);
        }
    }

    public function search(Request $request){
        $panel = "pagamento";
        $field = strtolower($request->field);
        $search =htmlspecialchars($request->search);
        $pagamentos = Pagamento::where($field,'like','%'.$search.'%')
                     ->orderBy('id','DESC')
                     ->paginate();
        return view('page.pagamento',compact('pagamentos','panel'));
    }

}
