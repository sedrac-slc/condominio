<?php

namespace App\Http\Controllers;

use App\Models\Pagamento;
use App\Models\PagamentoUser;
use App\Models\User;
use App\Models\UserMorador;
use App\Utils\AlertMessage;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PagamentoUserController extends Controller
{
    public function users($id,$optional = true){
        $panel = "pagamento";
        $pagamento = Pagamento::with('pagamento_users')->find($id);

        $builds = User::join('user_moradors','user_moradors.user_id','=','users.id')
                    ->orderBy('user_moradors.id','DESC');

        if(isset(Auth::user()->user_morador->id)){
            $builds = $builds->where('user_moradors.id', Auth::user()->user_morador->id);
        }
        $pagamentoIds = $pagamento->pagamento_users->map(function($q){
            return $q->user_morador_id;
        })->all();
        $view = 'page.pagamento.';
        if($optional){
            $users = $builds->whereNotIn('user_moradors.id', $pagamentoIds)
                            ->select('users.*','user_moradors.id as user_morador_id')->paginate();
            $view .= 'users';
        }else{
            $users = $builds
                    ->join('pagamento_users','pagamento_users.user_morador_id','=','user_moradors.id')
                    ->where('pagamento_users.pagamento_id',$pagamento->id)
                    ->select('users.*','user_moradors.id as user_morador_id','pagamento_users.id as pagamento_user_id','pagamento_users.checked_id','pagamento_users.file')
                    ->paginate();
            $view .= 'list';
        }
        return view($view,compact('users','pagamento','panel','pagamentoIds'));
    }

    public function list($id){
        return $this->users($id,false);
    }

    public function users_store(Request $request, $pagamento_id, $user_id){
        try {
            $data = [
                'user_morador_id'=>$user_id,
                'pagamento_id'=>$pagamento_id,
                'how_created'=>Auth::user()->id,
                'how_updated'=>Auth::user()->id,
            ];

            if($request->hasFile('file')){
                $file = $request->file('file');
                $fileName = uniqid().'.'.($file->getClientOriginalExtension());
                $filePath = $file->storeAs('pagamentos',$fileName);
                $data['file'] = $filePath;
            }

            if(isset(Auth::user()->user_membro->id)){
                $data['checked_id'] = Auth::user()->user_membro->id;
            }

            PagamentoUser::create($data);
            $alertMessage = AlertMessage::CREATE();
            toastr()->success($alertMessage->message,$alertMessage->type);
        } catch (Exception $e) {
            $alertMessage = AlertMessage::DANGER();
            toastr()->error($alertMessage->message,$alertMessage->type);
        }finally{
            return redirect()->route('pagamento.home');
        }
    }

    public function users_confirm($id){
        try {
            $alertMessage = AlertMessage::DANGER();
            if(isset(Auth::user()->user_membro->id)){
                $pagamentoUser = PagamentoUser::find($id);
                $pagamentoUser->update(['checked_id' => Auth::user()->user_membro->id]);
                $alertMessage = AlertMessage::CREATE();
            }
            toastr()->success($alertMessage->message,$alertMessage->type);
        } catch (Exception $e) {
            $alertMessage = AlertMessage::DANGER();
            toastr()->error($alertMessage->message,$alertMessage->type);
        }finally{
            return redirect()->back();
        }
    }

    public function search(Request $request,$pagamento_id){
        $panel = "pagamento";
        $pagamento = pagamento::find($pagamento_id);
        $field = strtolower($request->field);
        $search =htmlspecialchars($request->search);
        $users = UserMorador::usersNotpagamento()->where($field,'like','%'.$search.'%')
                     ->orderBy('id','DESC')
                     ->paginate();
        return view('page.pagamento.user',compact('users','pagamento','panel'));
    }

}
