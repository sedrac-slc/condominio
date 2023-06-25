<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserMorador extends Model
{
    use HasFactory;

    protected $fillable=[
        'id',
        'user_id',
        'how_created',
        'how_updated',
        'created_at',
        'updated_at'
    ];

    public function user(){
        return User::find($this->user_id);
    }

    public static function users(){
       return User::join('user_moradors','user_moradors.user_id','=','users.id')
                    ->select('users.*','user_moradors.id as user_morador_id');
    }

    public static function usersNotApartamento(){
      return DB::table('user_moradors_not_apartamento as users');
     }

     public function widthApartamento(){
        $apartamentoUsers = ApartamentoUser::where('user_morador_id',$this->id)->first();
        return isset($apartamentoUsers->id);
     }

     public function widthApartamentoToString(){
        return $this->widthApartamento() ? "morador" : "morador(x)";
    }

}
