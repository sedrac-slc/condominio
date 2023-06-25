<?php

namespace App\Http\Controllers;

use App\Models\Apartamento;
use App\Models\ApartamentoUser;
use App\Models\User;
use App\Models\UserMorador;
use App\Utils\AlertMessage;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApartamentoUserController extends Controller
{

    public function users($id){
        $panel = "apartamento";
        $apartamento = Apartamento::find($id);
        $users = UserMorador::usersNotApartamento()->orderBy('id','DESC')->paginate();
        return view('page.apartamento.user',compact('users','apartamento','panel'));
    }

    public function users_store($apartamento_id, $user_id){
        try {

            ApartamentoUser::create([
                'user_morador_id'=>$user_id,
                'apartamento_id'=>$apartamento_id,
                'how_created'=>Auth::user()->id,
                'how_updated'=>Auth::user()->id,
            ]);
            $alertMessage = AlertMessage::CREATE();
            toastr()->success($alertMessage->message,$alertMessage->type);
        } catch (Exception $error) {
            dd($error);
            $alertMessage = AlertMessage::DANGER();
            toastr()->error($alertMessage->message,$alertMessage->type);
        }finally{
            return redirect()->route('apartamento.home');
        }
    }

    public function search(Request $request,$apartamento_id){
        $panel = "apartamento";
        $apartamento = Apartamento::find($apartamento_id);
        $field = strtolower($request->field);
        $search =htmlspecialchars($request->search);
        $users = UserMorador::usersNotApartamento()->where($field,'like','%'.$search.'%')
                     ->orderBy('id','DESC')
                     ->paginate();
        return view('page.apartamento.user',compact('users','apartamento','panel'));
    }

}
