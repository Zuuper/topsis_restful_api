<?php

namespace App\Http\Requests\Warung;

use Illuminate\Foundation\Http\FormRequest;

class CreateWarungRequest extends FormRequest
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
            'id_fintech'=> 'required',
            'nama_pemilik'=> 'required',
            'nik_pemilik'=> 'required|numeric',
            'alamat'=> 'required',
            'nama_warung'=> 'required',
            'username_warung'=> 'required',
            'password'=> 'required',
            'no_rekening'=> 'required|numeric',
            'no_telpon'=> 'required|numeric'
        ];
    }
}
