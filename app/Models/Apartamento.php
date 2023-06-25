<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Apartamento extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'num_casa',
        'dimensao',
        'descricao',
        'how_created',
        'how_updated',
        'created_at',
        'updated_at'
    ];

    public function registerUser($id){
        $this->update([
            'how_updated' => $id,
            'how_created' => $id,
            'created_at' => Carbon::now()
        ]);
    }

    public function registerUserCreate($id){
        $this->update([
            'how_created' => $id,
            'created_at' => Carbon::now()
        ]);
    }

    public function registerUserUpdate($id){
        $this->update([
            'how_updated' => $id,
            'updated_at' =>  Carbon::now()
        ]);
    }

    public function isClosed(){
        $apartamentoUsers = ApartamentoUser::where('apartamento_id',$this->id)->first();
        return isset($apartamentoUsers->id);
    }

    public function morador(){
        if(!$this->isClosed()) return User::empty();
        $apartamentoUsers = ApartamentoUser::where('apartamento_id',$this->id)->first();
        return UserMorador::find($apartamentoUsers->user_morador_id)->user();
    }

    public function agendar(Servico $servico): bool{
        $agendar = AgendarServico::where([
            'servico_id' => $servico->id,
            'apartamento_id' => $this->id
        ])->first();
        return isset($agendar->id);
    }

    public function reclamacao(Servico $servico): bool{
        $agendar = ReclamacaoServico::where([
            'servico_id' => $servico->id,
            'apartamento_id' => $this->id
        ])->first();
        return isset($agendar->id);
    }

}
