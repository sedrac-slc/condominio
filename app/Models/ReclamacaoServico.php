<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReclamacaoServico extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'servico_id',
        'apartamento_id',
        'motivo',
        'descricao',
        'how_created',
        'how_updated',
        'created_at',
        'updated_at'
    ];

}
