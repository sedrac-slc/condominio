<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reuniao extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'tema',
        'hora_comeco',
        'data',
        'how_created',
        'how_updated',
        'created_at',
        'updated_at'
    ];

    public function howCreated() : User{
        return User::find($this->how_created);
    }

    public function howUpdated() : User{
        return User::find($this->how_updated);
    }

    public function registerUser($id){
        $user = User::find($id);
        $this->update([
            'how_updated' => $user->id,
            'how_created' => $user->id,
            'created_at' => Carbon::now()
        ]);
    }

    public function registerUserCreate($id){
        $user = User::find($id);
        $this->update([
            'how_created' => $user->id,
            'created_at' => Carbon::now()
        ]);
    }

    public function registerUserUpdate($id){
        $user = User::find($id);
        $this->update([
            'how_updated' => $user->id,
            'updated_at' =>  Carbon::now()
        ]);
    }

}
