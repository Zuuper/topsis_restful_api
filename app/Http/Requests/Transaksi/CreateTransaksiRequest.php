<?php

namespace App\Http\Requests\Transaksi;

use Illuminate\Foundation\Http\FormRequest;

class CreateTransaksiRequest extends FormRequest
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
            'id_nasabah' => 'required|numeric',
            'id_warung' => 'required|numeric',
            'jumlah_transaksi' => 'required|numeric',
            'catatan' => 'required',
            'pin_transaksi_nasabah'=> 'required|numeric'
        ];
    }
}
