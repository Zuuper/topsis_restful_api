<?php

namespace App\Http\Requests\TransferAntarNasabah;

use Illuminate\Foundation\Http\FormRequest;

class CreateTransferAntarNasabahRequest extends FormRequest
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
            'id_nasabah_pengirim'=> 'required|numeric',
            'id_nasabah_penerima'=> 'required|numeric',
            'jumlah_transfer'=> 'required|numeric',
            'catatan'=> 'required',
            'pin_transaksi_nasabah'=> 'required|numeric'
        ];
    }
}
