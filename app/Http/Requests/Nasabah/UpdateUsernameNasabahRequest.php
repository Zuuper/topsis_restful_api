<?php

namespace App\Http\Requests\Nasabah;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUsernameNasabahRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username_nasabah'  => "required|unique:tb_nasabah,username_nasabah,{$this->nasabah->id_nasabah}",
            'password'          => 'required'
        ];
    }
}
