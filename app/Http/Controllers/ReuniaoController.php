<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReuniaoRequest;
use App\Models\Reuniao;
use App\Utils\AlertMessage;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReuniaoController extends Controller
{
    public function index(){
        $panel = "reuniao";
        $reunioes = Reuniao::orderBy('id','DESC')->paginate();
        return view('page.reuniao',compact('reunioes','panel'));
    }

    public function store(ReuniaoRequest $request){
        try{
            $reuniao = Reuniao::create($request->all());
            $reuniao->registerUser(Auth::user()->id);
            $alertMessage = AlertMessage::CREATE();
            toastr()->success($alertMessage->message,$alertMessage->type);
        }catch(Exception){
            $alertMessage = AlertMessage::DANGER();
            toastr()->error($alertMessage->message,$alertMessage->type);
        }finally{
            return redirect()->route('reuniao.home');
        }
    }

    public function update(ReuniaoRequest $request,$id){
        try{
            $reuniao = Reuniao::find($id);
            $reuniao->update($request->all());
            $reuniao->registerUserUpdate(Auth::user()->id);
            $alertMessage = AlertMessage::WARNING();
        }catch(Exception){
            $alertMessage = AlertMessage::DANGER();
        }finally{
            return redirect()->route('reuniao.home')
                             ->with($alertMessage->type,$alertMessage->message);
        }
    }

    public function delete($id){
        try{
            $reuniao = Reuniao::find($id);
            $reuniao->delete();
            $alertMessage = AlertMessage::SUCCESS();
        }catch(Exception){
            $alertMessage = AlertMessage::DANGER();
        }finally{
            return redirect()->route('reuniao.home')
                             ->with($alertMessage->type,$alertMessage->message);
        }
    }

    public function search(Request $request){
        $panel = "reuniao";
        $field = strtolower($request->field);
        $search =htmlspecialchars($request->search);
        $reunioes = Reuniao::where($field,'like','%'.$search.'%')
                     ->orderBy('id','DESC')
                     ->paginate();
        return view('page.reuniao',compact('reunioes','panel'));
    }

}
