<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PagamentoUser extends Model
{
    use HasFactory;

    protected $fillable=[
        'id',
        'user_morador_id',
        'pagamento_id',
        'how_created',
        'how_updated',
        'created_at',
        'updated_at'
    ];

    public function pagamento(){
        return $this->belongsTo(Pagamento::class);
    }

}
