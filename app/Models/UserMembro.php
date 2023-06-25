<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMembro extends Model
{
    use HasFactory;

    protected $fillable=[
        'id',
        'user_id',
        'funcao',
        'how_created',
        'how_updated',
        'created_at',
        'updated_at'
    ];

    public function user(){
        return User::find($this->user_id);
    }
}
