<?php

namespace App\Http\Requests\Promo;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePromoRequest extends FormRequest
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
            'id_warung'=>'required',
            'tanggal_mulai'=>'required',
            'tanggal_berakhir'=>'required',
            'diskon'=>'required|numeric',
            'keterangan'=>'required',
            'password_warung'=>'required'
        ];
    }
}
