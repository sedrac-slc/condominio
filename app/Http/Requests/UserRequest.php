<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'genero' => ['required', 'regex:/[MASCULINO|FEMENINO]/u'],
            'data_nascimento' => ['required', 'date'],
            'telefone' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }

    public static function rulesNotCheckPasswordAndEmail(){
        return [
            'name' => ['required', 'string', 'max:255'],
            'genero' => ['required', 'regex:/[MASCULINO|FEMENINO]/u'],
            'data_nascimento' => ['required', 'date'],
            'telefone' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255']
        ];
    }

    public function verifyPasswordsEquals():bool{
        if(!isset($this->password,$this->password_confirmation)) return false;
        return $this->password == $this->password_confirmation;
    }

}
