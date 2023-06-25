<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servico extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nome',
        'descricao',
        'how_created',
        'how_updated',
        'created_at',
        'updated_at'
    ];

    public function registerServicoUpdate($id){
        $this->update([
            'how_updated' => $id,
            'updated_at' =>  Carbon::now()
        ]);
    }


    public function registerServico($id){
        $this->update([
            'how_created' => $id,
            'how_updated' => $id,
            'updated_at' =>  Carbon::now()
        ]);
    }

}
