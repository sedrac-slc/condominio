<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReuniaoRequest extends FormRequest
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
            'tema' => ['required'],
            'data' => ['required'],
            'hora_comeco' => ['required'],
            'how_created' => [],
            'how_updated ' => []
        ];
    }
}
