<?php

use App\Models\AgendarServico;
use App\Models\ApartamentoUser;
use App\Models\Notificacao;
use App\Models\Reclamacao;
use App\Models\ReclamacaoServico;
use App\Models\User;
use App\Models\UserMorador;
use App\Models\UserMembro;
use App\Models\PagamentoUser;

if (!function_exists('howCreated')) {
    function howCreated($id)
    {
        $user = User::find($id);
        return isset($user->id) ? $user : "" ;
    }
}

if (!function_exists('howUpdated')) {
    function howUpdated($id)
    {
        $user = User::find($id);
        return isset($user->id) ? $user : "" ;
    }
}

if (!function_exists('apartamentoUser')) {
    function apartamentoUser($user_id):  ApartamentoUser
    {
        $morador = UserMorador::where('user_id',$user_id)->first();
        return  ApartamentoUser::where('user_morador_id',$morador->id)->first();
    }
}

if (!function_exists('userMembro')) {
    function userMembro($user_id)
    {
        $membro = UserMembro::find($user_id);
        return User::find($membro->user_id);
    }
}

if (!function_exists('userMoradorPagementoUser')) {
    function userMoradorPagementoUser($user_id, $pagamento_id)
    {
        $membro = PagamentoUser::where([
            'user_morador_id' => $user_id,
            'pagamento_id' => $pagamento_id
        ])->first();
        return isset($membro->id);
    }
}

if (!function_exists('rulesOfString')) {
    function rulesOfString($id):  string
    {
        return  User::find($id)->rulesToString() ;
    }
}

if (!function_exists('countUserInReuniao')) {
    function countUserInReuniao($reuniao):  string
    {
        return  Notificacao::where('reuniao_id',$reuniao->id)->count();
    }
}

if (!function_exists('reclamacaoUser')) {
    function reclamacaoUser($user_id):  int
    {
        return  Reclamacao::where('user_membro_id',$user_id)->count();
    }
}

if(!function_exists('countAgendaServico')){
    function  countAgendaServico($servico_id){
        return AgendarServico::where('servico_id',$servico_id)->count();
    }
}

if(!function_exists('countReclamacaoServico')){
    function  countReclamacaoServico($servico_id){
        return ReclamacaoServico::where('servico_id',$servico_id)->count();
    }
}
