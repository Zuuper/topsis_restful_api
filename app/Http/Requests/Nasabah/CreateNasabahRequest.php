<?php

namespace App\Http\Requests\Nasabah;

use Illuminate\Foundation\Http\FormRequest;

class CreateNasabahRequest extends FormRequest
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
            'id_fintech' => 'required',
            'id_membership' => 'required',
            'id_dompet' => 'required',
            'nama_nasabah' => 'required',
            'nik_nasabah' => 'required|numeric',
            'alamat_nasabah' => 'required',
            'username_nasabah' => 'required|unique:tb_nasabah,username_nasabah',
            'password_nasabah' => 'required',
            'no_rekening_nasabah' => 'required|unique:tb_nasabah,no_rekening_nasabah',
            'pin_transaksi_nasabah' => 'required|numeric',
            'no_telpon_nasabah' => 'required|numeric'
        ];
    }
}
