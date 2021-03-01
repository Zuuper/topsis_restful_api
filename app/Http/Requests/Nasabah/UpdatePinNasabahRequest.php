<?php

namespace App\Http\Requests\Nasabah;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePinNasabahRequest extends FormRequest
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
            'pin_transaksi_baru' => 'required|numeric',
            'pin_transaksi_lama' => 'required|numeric',
            'password' => 'required',
        ];
    }
}
