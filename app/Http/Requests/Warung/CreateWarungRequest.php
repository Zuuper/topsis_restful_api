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
            'id_dompet' => 'required',
            'nama_pemilik'=> 'required',
            'nik_pemilik'=> 'required|numeric',
            'alamat_warung'=> 'required',
            'nama_warung'=> 'required',
<<<<<<< HEAD
            'username_warung'=> 'required|unique:tb_warung,username_warung',
            'password_warung'=> 'required',
            'no_rekening_warung'=> 'required|unique:tb_warung,no_rekening_warung',
=======
            'username_warung'=> 'required',
            'password_warung'=> 'required',
>>>>>>> 172c6aab868fd92ed25653e2290acfcb2b7dd71b
            'no_telpon_warung'=> 'required|numeric'
        ];
    }
}
