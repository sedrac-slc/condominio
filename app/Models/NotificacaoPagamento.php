<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificacaoPagamento extends Model
{
    use HasFactory;

    protected $fillable = ['user_membro_id', 'pagamento_user_id','how_created'];

}
