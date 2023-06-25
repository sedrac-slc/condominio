<?php

namespace App\Models;

use App\Utils\Enum\FuncaoEnum;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'telefone',
        'genero',
        'estado',
        'data_nascimento',
        'how_created',
        'how_updated',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function  notificacao(){
        return $this->hasMany(Notificacao::class,'user_id','id');
    }

    public function  user_membro(){
        return $this->hasOne(UserMembro::class);
    }

    public function  user_morador(){
        return $this->hasOne(UserMorador::class);
    }

    public function registerUserCreate(User $user){
        $this->update([
            'how_created' => $user->id,
            'created_at' => Carbon::now()
        ]);
    }

    public function registerUserUpdate(User $user){
        $this->update([
            'how_updated' => $user->id,
            'updated_at' =>  Carbon::now()
        ]);
    }

    public function registerUser(User $user){
        $this->update([
            'how_created' => $user->id,
            'how_updated' => $user->id,
            'updated_at' =>  Carbon::now()
        ]);
    }

    public static function empty(): User{
        return new User(['id'=>-1]);
    }

    public function isEmpty() : bool{
        if(!isset($this->id)) return true;
        return  $this->id < 1;
    }

    public function isMembro(): bool{
        return isset(Auth::user()->user_membro->id);
    }

    public function isMorador(): bool{
        $morador = UserMorador::where('user_id',$this->id)->first();
        return isset($morador->id);
    }

    public function isMoradorResidente(): bool{
        $userMorador = UserMorador::where('user_id',$this->id)->first();
        if(!isset($userMorador->id)) return false;
        $apartamento =  ApartamentoUser::where('user_morador_id',$userMorador->id)->first();
        return isset($apartamento->id);
    }

    public function rulesToString() : string{
        $join = "";
        if($this->isMembro()){
           $menbro = UserMembro::where('user_id',$this->id)->first();
           $join = FuncaoEnum::get($menbro->funcao);
        }

        if($this->isMorador()){
            $morador = UserMorador::where('user_id',$this->id)->first();
            $text = $morador->widthApartamentoToString();
            $join .=  $join == "" ? $text : ",".$text;
         }

        return $join;
    }


}
