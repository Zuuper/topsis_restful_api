<?php

namespace App\Http\Requests;

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
            'id_membership',
            'nama_nasaba',
            'nik_nasabah',
            'alamat',
            'username_nasabah',
            'password',
            'pin_transaksi',
            'no_rekening',
            'no_telpon',
            'status',
            'tanggal_aktif'
        ];
    }
}
