<?php

namespace App\Http\Requests\Nasabah;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBiodataNasabahRequest extends FormRequest
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
            'nama_nasabah' => 'required',
            'nik_nasabah' => 'required|numeric',
            'alamat_nasabah' => 'required',
            'password_nasabah' => 'required',
            'no_telpon_nasabah' => 'required|numeric'
            
        ];
    }
}
