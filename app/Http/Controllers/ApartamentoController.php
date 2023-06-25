<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApartamentoRequest;
use App\Models\Apartamento;
use App\Utils\AlertMessage;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ApartamentoController extends Controller
{
    public function index(){
        $panel = "apartamento";
        $apartamentos = Apartamento::orderBy('id','DESC')->paginate();
        return view('page.apartamento',compact('apartamentos','panel'));
    }

    public function store(ApartamentoRequest $request){
        try{

            $apartamento = Apartamento::create($request->all());
            $apartamento->registerUser(Auth::user()->id);
            $alertMessage = AlertMessage::CREATE();
            toastr()->success($alertMessage->message,$alertMessage->type);
        }catch(Exception){
            $alertMessage = AlertMessage::DANGER();
            toastr()->error($alertMessage->message,$alertMessage->type);
        }finally{
            return redirect()->route('apartamento.home');
        }
    }

    public function update(ApartamentoRequest $request,$id){
        try{
            $apartamento = Apartamento::find($id);
            $apartamento->update($request->all());
            $apartamento->registerUserUpdate(Auth::user()->id);
            $alertMessage = AlertMessage::WARNING();
            toastr()->success($alertMessage->message,$alertMessage->type);
        }catch(Exception){
            $alertMessage = AlertMessage::DANGER();
            toastr()->error($alertMessage->message,$alertMessage->type);
        }finally{
            return redirect()->route('apartamento.home');
        }
    }

    public function delete($id){
        try{
            $apartamento = Apartamento::find($id);
            $apartamento->delete();
            $alertMessage = AlertMessage::SUCCESS();
            toastr()->success($alertMessage->message,$alertMessage->type);
        }catch(Exception){
            $alertMessage = AlertMessage::DANGER();
            toastr()->error($alertMessage->message,$alertMessage->type);
        }finally{
            return redirect()->route('apartamento.home');
        }
    }

    public function search(Request $request){
        $panel = "apartamento";
        $field = strtolower($request->field);
        $search =htmlspecialchars($request->search);
        $apartamentos = Apartamento::where($field,'like','%'.$search.'%')
                     ->orderBy('id','DESC')
                     ->paginate();
        return view('page.apartamento',compact('apartamentos','panel'));
    }

    public function getUserInApartamento($apart_id){
        $sql = DB::select('CALL get_user_in_apartamento(?)',[$apart_id])[0];
        return response()->json( (object)[
            "id" => $sql->id,
            "name" => $sql->name,
            "email" => $sql->email,
            "genero" => $sql->genero,
            "telefone" => $sql->telefone,
            "dataNascimento" => $sql->data_nascimento,
            "nameCreated" => howCreated($sql->how_created)->name,
            "nameUpdated" => howUpdated($sql->how_updated)->name,
            "createdAt" => $sql->created_at,
            "updatedAt" => $sql->updated_at
        ]);
    }

}
