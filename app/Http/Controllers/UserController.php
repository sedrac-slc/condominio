<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Models\UserMembro;
use App\Models\UserMorador;
use App\Utils\AlertMessage;
use App\Utils\Enum\FuncaoEnum;
use App\Utils\Enum\UserTypeEnum;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(){
        $panel = "user";
        $userTypeEnum = UserTypeEnum::listAll();
        $funcaoEnum = FuncaoEnum::listAllNotDef();
        $auth = User::with('user_membro')->find(Auth::user()->id);
        $users = User::with('user_membro')->orderBy('id','DESC')->paginate();
        return view('page.user',compact('users','funcaoEnum','userTypeEnum','panel','auth'));
    }

    public function register(UserRequest $request){
        try{
            $alertMessage = AlertMessage::DANGER();
            if($request->verifyPasswordsEquals()){
                $data = RegisterController::createField($request->all());
                $user = User::create($data);
                $user->registerUser($user);
                Auth::login($user);
                toastr()->success($alertMessage->message,$alertMessage->type);
                return redirect()->route('home');
            }else{
                toastr()->error($alertMessage->message,$alertMessage->type);
                return redirect()->route('register');
            }
        }catch(Exception){
            toastr()->error($alertMessage->message,$alertMessage->type);
            return redirect()->route('register');
        }
    }

    public function create(UserRequest $request){
         try{
            if($request->verifyPasswordsEquals()){
                $auth = User::find(Auth::user()->id);
                $array = RegisterController::createField($request->all());
                $user = User::create($array);
                $user->registerUser($auth);
                $this->userDefinerType($request,$user);
                $alertMessage = AlertMessage::CREATE();
                toastr()->success($alertMessage->message,$alertMessage->type);
            }else{
                $alertMessage = AlertMessage::DANGER();
                toastr()->error($alertMessage->message,$alertMessage->type);
            }
        }catch(Exception $e){
            dd($e);
            toastr()->error($alertMessage->message,$alertMessage->type);
        }finally{
            return redirect()->route('user.home');
        }
    }

    private function userDefinerType(Request $request,User $user){
        try{

            $auth = Auth::user()->id;
            switch($request->user_type_perfil){
                case "MORADOR":
                    UserMorador::updateOrCreate(['user_id'=> $user->id],[
                        "user_id" => $user->id,
                        'how_created'=> $auth,
                        "how_updated"=> $auth,
                        "updated_at"=>Carbon::now()
                    ]);
                    break;
                case "MEMBRO":
                    $request->validate([
                        'funcao' => ['required','string']
                    ]);
                    UserMembro::updateOrCreate(['user_id'=> $user->id],[
                        "funcao"=> $request->funcao,
                        "user_id" => $user->id,
                        'how_created'=> $auth,
                        "how_updated"=> $auth,
                        "updated_at"=>Carbon::now()
                    ]);
                    break;
            }
        }catch(Exception){
            throw new Exception();
        }
    }

    public function update(Request $request){
        return $this->update_user($request,Auth::user()->id);
    }

    public function update_user(Request $request,$id){
        $request->validate(UserRequest::rulesNotCheckPasswordAndEmail());
        try{
            $user = User::find($id);
            $auth =  User::find(Auth::user()->id);
            $user->update($request->all());
            $user->registerUserUpdate($auth);
            $this->userDefinerType($request,$user);
            $alertMessage = AlertMessage::WARNING();
            toastr()->warning($alertMessage->message,$alertMessage->type);
            return redirect()->route('user.home');
        }catch(Exception){
            $alertMessage = AlertMessage::DANGER();
            toastr()->error($alertMessage->message,$alertMessage->type);
            return redirect()->route('user.home');
        }
    }

    public function delete(){
        if(isset(Auth::user()->id)){
            $user = User::find(Auth::user()->id);
            $user->delete();
        }
        Auth::logout();
    }

    public function delete_user($id){
        try{
            $user = User::find($id);
            $user->delete();
            $alertMessage = AlertMessage::SUCCESS();
            toastr()->info($alertMessage->message,$alertMessage->type);
        }catch(Exception){
            toastr()->error($alertMessage->message,$alertMessage->type);
        }finally{
            return redirect()->route('user.home');
        }
    }

    public function search(Request $request){
        $panel = "user";
        $userTypeEnum = UserTypeEnum::listAll();
        $funcaoEnum = FuncaoEnum::listAllNotDef();
        $field = strtolower($request->field);
        $search =htmlspecialchars($request->search);
        $auth = User::with('user_membro')->find(Auth::user()->id);
        $users = User::where($field,'like','%'.$search.'%')
                     ->where('id','!=',Auth::user()->id)
                     ->orderBy('id','DESC')
                     ->paginate();
        return view('page.user',compact('users','funcaoEnum','userTypeEnum','panel','auth'));
    }

    public function getApartamentoUser($user_id){
        $sql = DB::select('CALL get_apartamento_user(?)',[$user_id])[0];
        return response()->json( (object)[
            "id" => $sql->id,
            "numCasa" => $sql->num_casa,
            "dimensao" => $sql->dimensao,
            "descricao" => $sql->descricao,
            "nameCreated" => howCreated($sql->how_created)->name,
            "nameUpdated" => howUpdated($sql->how_updated)->name,
            "createdAt" => $sql->created_at,
            "updatedAt" => $sql->updated_at
        ]);
    }

}
