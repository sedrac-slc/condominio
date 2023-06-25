<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pagamento extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nome',
        'valor',
        'descricao',
        'how_created',
        'how_updated',
        'created_at',
        'updated_at'
    ];

    public function pagamento_users(){
        return $this->hasMany(PagamentoUser::class);
    }

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

}
